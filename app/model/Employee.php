<?php

namespace App\Model;

use App\Core\Model;

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


}