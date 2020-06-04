<?php

namespace App\Core;

use \PDO;

class Database {

    private $_pdo;
    private static $_instance = null;
    private $_query;
    private $_error = false;
    private $_result;
    private $_count = 0;
    private $_lastInsertedId = null;
    private $_errorInfo = null;
    private $_prepareSign = null;

    private function __construct()
    {
        $config = require(ROOT . DS . 'app' . DS . 'config' . DS . 'database.php');
        try
		{
            switch($config['db_dsn']) {
                case 'mysql':
                    $str_connect = sprintf(
                        '%s:charset=%s;host=%s;dbname=%s;port=%s', 
                        $config['db_dsn'],
                        $config['db_charset'],
                        $config['db_host'],
                        $config['db_name'],
                        $config['db_port']
                    );
                    $this->_prepareSign = '?';
                    break;
                case 'pgsql':
                    $str_connect = sprintf(
                        '%s:host=%s;dbname=%s;port=%s', 
                        $config['db_dsn'],
                        $config['db_host'],
                        $config['db_name'],
                        $config['db_port']
                    );
                    $this->_prepareSign = '$%s';
                    break;
                case 'sqlsrv':
                    $str_connect = sprintf(
                        'sqlsrv:Server=%s;Database=%s', 
                        $config['db_host'],
                        $config['db_name']
                    );
                    $this->_prepareSign = '?';
                    break;
            }
            $this->_pdo = new PDO($str_connect , $config['db_user'], $config['db_password']);
            if (DEBUG) {
                $this->_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->_pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            }
        } catch (PDOException $exception) {
            // errorLog($exception->getMessage());
        }
    }

    public static function getInstance()
    {
        if (self::$_instance == null) {
            self::$_instance = new Database();
        }
        return self::$_instance;
    }

    public function query($sql, $params = [], $class = false)
    {
        $this->_error = false;
        if ($this->_query = $this->_pdo->prepare($sql)) {
            if ($this->_query->execute($params)) {
                $this->_lastInsertId = $this->_pdo->lastInsertId();
                if ($class) {
                    $this->_result = $this->_query->fetchAll(PDO::FETCH_CLASS, $class);
                } else {
                    $this->_result = $this->_query->fetchAll(PDO::FETCH_OBJ);
                }
                $this->_count = $this->_query->rowCount();
            } else {
                $this->_errorInfo = $this->_query->errorInfo();
                $this->_error = true;
            }
        }
        return $this;
    }

    public function insert ($table, $fields = [])
    {
        $field_arr = [];
        $value_arr = [];
        $values = [];
        foreach ($fields as $field => $value) {
            $field_arr[] = "'" . $field . "'";
            $value_arr[] = "?";
            $values[] = $value;
        }
        $sql = "INSERT INTO $table (".implode(', ', $field_arr).") VALUES (".implode(', ', $value_arr).");";
        if (!$this->query($sql, $values)->error()) {
            return true;
        }
        return false;
    }



}