<?php

namespace App\Core;

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
                    $params['conditions'][]= ' deleted != 1';
                } else {
                    $params['conditions'] .= ' deleted != 1';
                }
            } else {
                $params['conditions'] = ' deleted != 1';
            }
        }
        return $params;
    }

    public function isNew()
    {
        return (property_exists($this, 'id')) && !empty($this->id) ? false : true;
    }

    public function data()
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