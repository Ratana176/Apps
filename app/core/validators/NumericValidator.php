<?php

namespace App\Core\Validators;

class NumericValidator extends BaseValidator
{
    public function runValidator()
    {
        $value = $this->_model->{$this->_field};
        return !empty($value) && is_numeric($value);
    }
}