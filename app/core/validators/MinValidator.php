<?php

namespace App\Core\Validators;

class MinValidator extends BaseValidator
{
    public function runValidator()
    {
        $value = $this->_model->{$this->_field};
        return strlen($value) >= $this->_rule;
    }
}