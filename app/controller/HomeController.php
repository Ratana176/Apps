<?php

namespace App\Controller;

use App\Core\{Controller, Database};

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
        $time_start = microtime(true);

        echo 'Hello worl';

        $time_end = microtime(true);
        $time = $time_end - $time_start;
        echo "Did nothing in $time seconds\n";

        // $db->insert($table, $fields);
        //$this->view->render('home.index');
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