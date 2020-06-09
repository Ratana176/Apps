<?php

namespace App\Core\Validators;

class MaxValidator extends BaseValidator
{

    public function __construct($model, $param)
    {
        parent::__constructor($model, $param);
    }


    public function runValidator()
    {
        $value = $this->_model->{$this->_field};
        return strlen($value) <= $this->_rule;
    }
}