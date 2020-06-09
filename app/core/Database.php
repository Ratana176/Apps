<?php

namespace App\Core;

use \PDO;
use \PDOException;

class Database
{

    private $_pdo;
    private static $_instance = null;
    private $_query;
    private $_error = false;
    private $_result;
    private $_count = 0;
    private $_lastInsertId = null;
    private $_errorInfo = null;
    private $_qouteSign = null;

    private function __construct()
    {
        $config = require(ROOT . DS . 'app' . DS . 'config' . DS . 'database.php');
        try {

            $str_connect = $this->_setupConnection($config);
            $this->_pdo = new PDO($str_connect, $config['db_user'], $config['db_password']);

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

    private function _setupConnection ($config) {

        $str_connect = '';
        switch ($config['db_dsn']) {
            case 'mysql':
                $str_connect = sprintf(
                    '%s:charset=%s;host=%s;dbname=%s;port=%s',
                    $config['db_dsn'],
                    $config['db_charset'],
                    $config['db_host'],
                    $config['db_name'],
                    $config['db_port']
                );
                $this->_qouteSign = "`%s`";
                break;
            case 'pgsql':
                $str_connect = sprintf(
                    '%s:host=%s;dbname=%s;port=%s',
                    $config['db_dsn'],
                    $config['db_host'],
                    $config['db_name'],
                    $config['db_port']
                );
                $this->_qouteSign = "'%s'";
                break;
            case 'sqlsrv':
                $str_connect = sprintf(
                    'sqlsrv:Server=%s;Database=%s',
                    $config['db_host'],
                    $config['db_name']
                );
                $this->_qouteSign = "'%s'";
                break;
        }

        return $str_connect;
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

    public function insert($table, $fields = [])
    {
        $field_arr = [];
        $value_arr = [];
        $values = [];

        foreach ($fields as $field => $value) {

            $prepare_field = str_replace('.', '__', $field);
            $field_arr[] = sprintf($this->_qouteSign, $field);
            $value_arr[] = sprintf(':%s', $prepare_field);
            $values[$prepare_field] = $value;

        }

        $sql = "INSERT INTO $table (" . implode(', ', $field_arr) . ") VALUES (" . implode(', ', $value_arr) . ");";
        if (!$this->query($sql, $values)->error()) {
            return true;
        }

        return false;
    }

    /**
     * update record
     * @param String $table table's name
     * @param Array $field field of table
     * @param Array $conditions condition where : contain key [conditions: logic of where, bind: value of field, orderBy, limit]
     * @return true if update success else return false.
     */
    public function update($table, $fields = [], $conditions = [])
    {
        $field_arr = [];
        $values = [];
        $where_clause = '';

        foreach ($fields as $field => $value) {

            $prepare_field = str_replace('.', '__', $field);
            $field_arr[] = $field . ' = ' . sprintf(':%s', $prepare_field);
            $values[$prepare_field] = $value;

        }

        $where_clause = $this->where($conditions, $values);

        $sql = "UPDATE $table set " . implode(', ', $field_arr) . $where_clause;

        if (!$this->query($sql, $values)->error()) {
            return true;
        }

        return false;
    }

    public function delete($table, $conditions = [])
    {
        $values = [];

        $sql = "DELETE FROM $table ".$this->where($conditions, $values);

        if (!$this->query($sql, $values)->error()) {
            return true;
        }

        return false;
    }

    public function find($table, $conditions = [], $fields = [], $option = '', $classOutput = false)
    {
        $values = [];

        $sql = "SELECT $option ". (count($fields) > 0 ? implode(', ', $fields) : ' * ' ). " FROM $table " . $this->where($conditions, $values);
        if (!$this->query($sql, $values, $classOutput)->error()) {
            return $this->result();
        }

        return false;
    }

    public function findFirst($table, $conditions = [], $fields = [], $classOutput = false)
    {
        $conditions['limit'] = 1;

        $record = $this->find($table, $conditions, $fields, '', $classOutput);

        if ($record) {
            return $record[0];
        }

        return false;
    }

    /**
     * Generate condition for where
     * @param array $conditions  There key : conditions, bind, orderBy, limit, offset.
     * @param ref array $values the values will take out to passed to query function.
     * @return String where condition  
     */
    private function where($conditions, &$values = [])
    {
        $sub_sql = '';
        if (array_key_exists('conditions', $conditions)) {

            $where_clause = $conditions['conditions'];

            if (is_array($where_clause)) {

                $where_arr = [];

                foreach ($where_clause as $field => $value) {

                    $prepare_field = str_replace('.', '__', $field);
                    $where_arr[] = $field . ' = ' . sprintf(':%s', $prepare_field);
                    $values[$prepare_field] = $value;

                }

                $sub_sql .= ' WHERE ' . implode(' AND ', $where_arr);

            } elseif (is_string($where_clause)) {

                $sub_sql .= ' WHERE ' . $where_clause;

                if (array_key_exists('bind', $conditions)) {

                    $bind = $conditions['bind'];

                    foreach ($bind as $key => $value) {
                        $values[$key] = $value;
                    }

                }

            } else {
                /* passed invalid conditions. */
                return $sub_sql;
            }
        }

        if (array_key_exists('orderBy', $conditions)) {
            $sub_sql .= ' ORDER BY ' . $conditions['orderBy'];
        }

        if (array_key_exists('offset', $conditions)) {
            $sub_sql .= ' OFFSET ' . $conditions['offset'];
        }
        
        if (array_key_exists('limit', $conditions)) {
            $sub_sql .= ' LIMIT ' . $conditions['limit'];
        }

        return $sub_sql;
    }

    public function error()
    {
        return $this->_error;
    }

    public function result()
    {
        return $this->_result;
    }

    public function count()
    {
        return $this->_count;
    }

    public function lastInsertId()
    {
        return $this->_lastInsertId;
    }

    public function errorInfo()
    {
        return $this->_errorInfo;
    }

}
