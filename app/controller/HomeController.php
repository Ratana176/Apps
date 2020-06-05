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
        
        $table = 'companies';
        $fields = [
            'name' => 'ratana',
            'address' => 'new sdfsd Address',
            'license_no' => '1111111111'
        ];
        // $db->insert($table, $fields);
        $condition = [
            'conditions' => ['id' => '8']
        ];

        // $db->update($table, $fields, $condition);

        // $db->delete($table, $condition);
        print_r($db->findFirst($table));
        // print_r($db->result());
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