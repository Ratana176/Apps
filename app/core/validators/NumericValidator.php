<?php

namespace App\Core\Validators;

class NumericValidator extends BaseValidator
{

    public function __construct($model, $param)
    {
        parent::__constructor($model, $param);
    }

    public function runValidator()
    {
        $value = $this->_model->{$this->_field};
        return !empty($value) && is_numeric($value);
    }
}