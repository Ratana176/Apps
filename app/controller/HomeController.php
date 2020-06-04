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
        // $this->view->render('home.index');
    }

    public function putAction()
    {
        print_r('put');

        // $this->view->render('home.index');
    }

    public function postAction()
    {
        print_r('post');

        // $this->view->render('home.index');
    }

    public function deleteAction()
    {
        print_r('delete');

        // $this->view->render('home.index');
    }
}