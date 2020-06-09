<?php

namespace App\Model;

use App\Core\Model;
use App\Core\Validators\{
    NumericValidator,
    RequireValidator,
    PhoneValidator
};


class Employee extends Model
{
    public $id;
    public $company_id;
    public $name;
    public $surname;
    public $telephone;
    public $salary;

    public function __construct() {
        parent::__construct('employees');
    }

    public function validator()
    {
        $this->runValidator(new NumericValidator($this, ['field' => 'company_id', 'rule'=> '','msg' => 'Invalid Company']));
        $this->runValidator(new NumericValidator($this, ['field' => 'salary', 'rule'=> '','msg' => 'Invalid Salary']));
        $this->runValidator(new PhoneValidator($this, ['field' => 'telephone', 'rule'=> '','msg' => 'Invalid Phone Number']));
    }
}