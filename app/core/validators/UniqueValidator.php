<?php

namespace App\Core\Validators;

class UniqueValidator extends BaseValidator
{
    public function runValidator()
    {
        $conditions = [
            'conditions' => [$this->_field => $this->_model->{$this->_field}]
        ];
        return !($this->_model->findFirst($conditions));
    }
}