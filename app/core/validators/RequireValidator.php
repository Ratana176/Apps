<?php

namespace App\Core\Validators;

class RequireValidator extends BaseValidator
{
    public function runValidator()
    {
        return !empty($this->_model->${$this->_field});       
    }
}