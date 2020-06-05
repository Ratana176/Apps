<?php

namespace App\Model;

class Company extends Model
{
    public $id;
    public $name;
    public $address;
    public $license_no;

    public function __construct()
    {
        $this->_table = 'companies';
    }
}