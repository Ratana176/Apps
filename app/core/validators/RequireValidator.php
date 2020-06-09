<?php

namespace App\Core\Validators;

class RequireValidator extends BaseValidator
{

    public function __construct($model, $param)
    {
        parent::__constructor($model, $param);
    }


    public function runValidator()
    {
        return !empty($this->_model->${$this->_field});
    }
}