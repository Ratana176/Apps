<?php

namespace App\Core;

use \stdClass;
use \ReflectionClass, ReflectionProperty, ReflectionException;

class Model
{
    protected $_db;
    protected $_table;
    protected $_modelName;
    protected $_softDelete = false;
    protected $_validates = true;

    public function __construct($table)
    {
        $this->_db = Database::getInstance();
        $this->_table = $table;
        $this->_modelName = str_replace(' ', '',ucwords(str_replace('_', ' ', $table)));
    }


    protected function _softDeleteParams ($params = [])
    {
        if ($this->_softDelete) {
            if(array_key_exists('conditions', $params)){
                if(is_array($params['conditions'])){
                    $params['conditions']['deleted']= '0';
                } else {
                    $params['conditions'] .= ' AND deleted = 0';
                }
            } else {
                $params['conditions']['deleted'] = '0';
            }
        }
        return $params;
    }

    public function insert($fields)
    {
        if (!count($fields)) return false;
        return $this->_db->insert($this->$_table, $fields);
    }

    public function update($fields, $conditions)
    {
        if (!count($fields)) return false;
        return $this->_db->update($this->_table, $fields, $conditions);
    }

    public function delete($conditions = [])
    {
        if (!isset($conditions['conditions']['id'])) {
            $conditions['conditions']['id'] =  $this->id;
        }
        if (property_exists($this, 'id') && !empty($this->id)) {
            if ($this->_softDelete) {
                return $this->update(['deleted' => '1'],$conditions);
            }
            return $this->_db->delete($this->_table, $conditions);
        }
        return false;
    }

    public function save()
    {
        return;
    }

    public function find($conditions, $fields = [], $option = '')
    {
        $conditions = $this->_softDeleteParams($conditions);
        return $this->_db->find($this->_table, $conditions, $fields, $option, get_class($this));
    }

    public function findFirst($conditions, $fields = [])
    {
        $conditions = $this->_softDeleteParams($conditions);
        return $this->_db->findFirst($this->_table, $conditions, $fields, get_class($this));
    }

    public function findById($id)
    {
        $conditions = [
            'conditions' => ['id' => $id]
        ];
        $conditions = $this->_softDeleteParams($conditions);
        return $this->_db->find($this->_table, $conditions);
    }
    public function assign($params, $list = [], $blackList = true)
    {
        foreach ($params as $field => $value) {
            $whiteList = true;
            if (count ($list) > 0) {
                if ($blackList) {
                    $whiteList = !in_array($field, $list);
                } else {
                    $whiteList = in_array($field, $list);
                }
            }
            if (property_exists($this, $field) && $whiteList) {
                $this->$field = $value;
            }
        }
        return $this;
    }

    public function isNew()
    {
        return (property_exists($this, 'id')) && !empty($this->id) ? false : true;
    }

    public function dataArray()
    {
        return $this->getObjectProperties();
    }

    public function dataObject()
    {
        return $this->getObjectProperties(true);
    }

    public function getObjectProperties($isObject = false)
    {
        try {
            $default_object = new stdClass();
            $default_arrays = [];

            $_object = new ReflectionClass($this);
            $is_public = $_object->getProperties(ReflectionProperty::IS_PUBLIC);
            $is_static = $_object->getProperties(ReflectionProperty::IS_STATIC);
            $filter = array_diff($is_public, $is_static);
            foreach ($filter as $property) {
                $name = $property->name;
                if ($property->class == $_object->name) {
                    if ($isObject)
                        $default_object->$name = $this->$name;
                    else
                        $default_arrays[$name] = $this->$name;
                }
            }
            return $isObject ? $default_object : $default_arrays;
        } catch (ReflectionException $e) {
            return null;
        }
    }
}