<?php

namespace App\Controller;

use App\Core\Controller;

class EmployeeController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->loadModel('Employee');
        $this->loadModel('Company');
    }

    public function index()
    {
        $result = $this->EmployeeModel->find();
        $this->view->render('employee.index', ['employee_list' => $result]);
    }

    public function create()
    {
        $employees = $this->EmployeeModel->assign($this->request->get());
        $companies = $this->CompanyModel->find();
        if ($this->request->isPost() && !$this->request->get('@ErrorPage')) {
            if ($this->EmployeeModel->save()) {

                infoView(
                    ['title' => 'Saved', 'data' => lang('messages.save_success')],
                    [/* data */], 
                    ['button_title' => lang('messages.back'), 'url' => "/employee"]
                );

            } else {

                errorView(
                    ['title' => 'Can not save', 'data' => implode('<br>',$this->EmployeeModel->getValidationErrors())],
                    $this->resolvedParamsRequest($this->request->get()), // data
                    ['button_title' => lang('messages.back'), 'url' => "/employee/create"]
                );

            }
        }
        $this->view->render('employee.create', ['employee' => $employees, 'companies' => $companies]);
    }

    public function store()
    {
        print('function: '.__METHOD__);
        $this->view->render('employee.index');
    }

    public function show()
    {
        print('function: '.__METHOD__);
        $this->view->render('employee.index');
    }

    public function edit()
    {
        print('function: '.__METHOD__);
        $this->view->render('employee.index');
    }

    public function update()
    {
        print('function: '.__METHOD__);
        $this->view->render('employee.index');
    }

    public function destroy()
    {
        print('function: '.__METHOD__);
        $this->view->render('employee.index');
    }
}