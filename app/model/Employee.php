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
        $this->runValidator(new NumericValidator($this, ['field' => 'company_id', 'rule'=> '','msg' => lang('validators.invalid_company')]));
        $this->runValidator(
            new RequireValidator(
                $this, 
                [
                    'field' => 'name', 
                    'rule'=> '',
                    'msg' => translate('validators.name_required', ['who' => lang('messages.the_employee')])
                ]
            )
        );
        $this->runValidator(new NumericValidator($this, ['field' => 'salary', 'rule'=> '','msg' => lang('validators.invalid_salary')]));
        $this->runValidator(new RequireValidator($this, ['field' => 'salary', 'rule'=> '','msg' => lang('validators.salary_reqired')]));
        $this->runValidator(new PhoneValidator($this, ['field' => 'telephone', 'rule'=> '','msg' => lang('validators.invalid_phone')]));
    }
}