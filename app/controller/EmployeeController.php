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
        if ($this->request->isPost() && !$this->request->get('@ErrorPage')) {
            if ($this->EmployeeModel->save()) {

                infoView(
                    ['title' => 'Saved', 'data' => lang('messages.save_success')],
                    [/* data */], 
                    ['button_title' => lang('messages.back'), 'url' => "/employee/". $this->EmployeeModel->lastInsertId() . '/edit']
                );

            } else {

                errorView(
                    ['title' => 'Can not save', 'data' => implode('<br>',$this->EmployeeModel->getValidationErrors())],
                    $this->resolvedParamsRequest($this->request->get()), // data
                    ['button_title' => lang('messages.back'), 'url' => "/employee/create"]
                );

            }
        }
        $this->view->render('employee.create', ['employee' => $employees]);
    }

    public function edit($id)
    {
        $employee = $this->EmployeeModel->findFirst(['conditions' => ['id' => $id]]);

        if ($this->request->isPut()) {

            if($this->update($id)) {

                infoView(
                    ['title' => 'Updated', 'data' => lang('messages.updated')],
                    [/* data */], 
                    ['button_title' => lang('messages.back'), 'url' => "/company/$employee->company_id/edit"]
                );

            } else {

                errorView(
                    ['title' => 'Can not update', 'data' => implode('<br>',$this->EmployeeModel->getValidationErrors())],
                    $this->resolvedParamsRequest($this->request->get()), // data
                    ['button_title' => lang('messages.back'), 'url' => "/employee/$id/edit"]
                );

            }
        } elseif ($this->request->get('@ErrorPage')) {
            $employee = $this->EmployeeModel->assign($this->request->get())->toDataObject();
            $employee->id = $id;
        }

        $this->view->render('employee.edit',['employee' => $employee]);
    }

    public function update($id)
    {
        $this->EmployeeModel->assign($this->request->get());
        $this->EmployeeModel->id = $id;
        return $this->EmployeeModel->save();
    }

}