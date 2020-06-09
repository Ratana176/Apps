<?php

namespace App\Model;

use App\Core\Model;
use App\Core\Validators\NumericValidator;

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
        $this->runValidator(new NumericValidator($this, ['field' => 'license_no', 'rule'=> '','msg' => 'Invalid License Number']));
    }
}