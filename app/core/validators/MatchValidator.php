<?php

namespace App\Core\Validators;

class MatchValidator extends BaseValidator
{
    public function runValidator()
    {
        $value = $this->_model->{$this->_field};
        return $value == $this->_rule;
    }
}