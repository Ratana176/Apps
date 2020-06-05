<?php

namespace App\Controller;

use App\Core\{Controller, Database, Route};

class HomeController extends Controller 
{
    public function __construct()
    {
        parent::__construct();
    }

    public function indexAction()
    {
        $db = Database::getInstance();
        
        $table = 'users';
        $fields = [
            'name' => 'test user',
            'password' => 'userpassword'
        ];
        $db->insert($table, $fields);
        //$this->view->render('home.index');
    }

    public function testValueAction()
    {
        print_r('put fuction called');

        // $this->view->render('home.index');
    }


    public function put1Action()
    {
        print_r('put fuction called');

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