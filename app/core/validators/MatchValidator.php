<?php

namespace App\Core\Validators;

class MatchValidator extends BaseValidator
{

    public function __construct($model, $param)
    {
        parent::__constructor($model, $param);
    }


    public function runValidator()
    {
        $value = $this->_model->{$this->_field};
        return $value == $this->_rule;
    }
}