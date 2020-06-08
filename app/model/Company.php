<?php

namespace App\Model;

use App\Core\Model;

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


}