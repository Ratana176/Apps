<?php

namespace App\Core\Validators;

class EmailValidator extends BaseValidator
{

    public function __construct($model, $param)
    {
        parent::__constructor($model, $param);
    }

    public function runValidator()
    {
        $value = $this->_model->{$this->field};
        return !empty($value) && filter_var($value, FILTER_VALIDATE_EMAIL);
    }
}