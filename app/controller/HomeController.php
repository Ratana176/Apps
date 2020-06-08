<?php

namespace App\Controller;

use App\Core\{Controller, Database, Route};
use App\Model\Company;

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
            'name' => 'chhorm',
            'address' => 'new address of new',
            'license_no' => '1234567'
        ];
        // $db->insert($table, $fields);
        $condition = [
            'conditions' => ['id' => '1']
        ];

        // $db->update($table, $fields, $condition);

        // $db->delete($table, $condition);
        $com = new Company();
        $result = $com->findFirst(['conditions' => ['id' => 1]]);
        //$this->view->render('home.index');
    }

    public function testLangueAction()
    {
        print_r(translate('messages.current_year', ['year' => '2030']));

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