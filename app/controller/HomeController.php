<?php

namespace App\Controller;

use App\Core\Controller;

class HomeController extends Controller 
{
    public function __construct()
    {
        parent::__construct();
    }

    public function indexAction()
    {
        $this->view->render('home.index');
    }
}