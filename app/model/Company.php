<?php

namespace App\Model;

use App\Core\Model;
use App\Core\Validators\{
    MaxValidator,
    NumericValidator,
    RequireValidator
};

class Company extends Model
{
    public $id;
    public $name;
    public $address;
    public $license_no;

    public function __construct()
    {
        parent::__construct('companies');
    }

    public function validator()
    {
        $this->runValidator(new NumericValidator($this, ['field' => 'license_no', 'rule'=> '','msg' => lang('validators.invalid_license_no')]));
        $this->runValidator(new MaxValidator($this, ['field' => 'license_no', 'rule'=> '14','msg' => lang('validators.max_license_no')]));
        $this->runValidator(new RequireValidator($this, ['field' => 'name', 'rule'=> '','msg' => translate('validators.name_required', ['who' => 'company'])]));
    }
}