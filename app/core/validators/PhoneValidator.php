<?php

namespace App\Core\Validators;

class PhoneValidator extends BaseValidator
{

    public function __construct($model, $param)
    {
        parent::__constructor($model, $param);
    }


    public function runValidator()
    {
        $value = $this->_model->{$this->_field};
        return preg_match('/^\(*\+*[0-9]{0,3}\)*-*[0-9]{0,3}[- ]*\(*[0-9]\d{2}\)*[- ]*\d{3}[- ]*\d{3,4}$/', $value);
    }
}