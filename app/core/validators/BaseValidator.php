<?php

namespace App\Core\Validators;

use \Exception;

abstract class BaseValidator
{
    protected $_rule;
    protected $_success = true;
    protected $_message = '';
    protected $_model;
    protected $_field;

    protected function __constructor($model, $param)
    {
        $this->_model = $model;
        if (!array_key_exists('field', $param)) {
            throw new Exception('You must add field to the pass param array');
        }
        $this->_field = $param['field'];

        if (!property_exists($model, $this->_field)) {
            throw new Exception("The field must exist in model $model");
        }

        if (!array_key_exists('msg', $param)) {
            throw new Exception('You must add msg to the pass param array');
        }
        $this->_message = $param['smg'];

        if (!array_key_exists('rule', $param)) {
            throw new Exception ('You must add rule to the pass param array');
        }
        $this->_rule = $param['rule'];

        try {
            $this->_success = $this->runValidator();
        } catch (Exception $e) {
            print_r('Exception validation on: ' . get_class($model). ':'. $e->getMessage());
        }

    }

    public function getField()
    {
        return $this->_field;
    }

    public function isSuccess()
    {
        return $this->_success;
    }

    public function getMessage()
    {
        return $this->_message;
    }

    public abstract function runValidator();
}