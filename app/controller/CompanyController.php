<?php

namespace App\Controller;

use App\Core\Controller;
use App\Model\Employee;

class CompanyController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->loadModel('Company');
        $this->loadModel('Employee');
    }

    public function index()
    {
        $result = $this->CompanyModel->find();
        $this->view->render('company.index', ['employee_list' => $result]);
    }

    public function create()
    {
        /**
         * get data from user input
         */
        $result = $this->CompanyModel->assign($this->request->get());

        /**
         * if we clicked save
         */
        if ($this->request->isPost() && !$this->request->get('@ErrorPage')) {
            if ($this->CompanyModel->save()) {

                infoView(
                    ['title' => 'Saved', 'data' => lang('messages.save_success')],
                    [/* data */], 
                    ['button_title' => lang('messages.back'), 'url' => "/company/". $this->CompanyModel->lastInsertId() ."/edit"]
                );

            } else {

                errorView(
                    ['title' => 'Can not save', 'data' => implode('<br>',$this->CompanyModel->getValidationErrors())],
                    $this->resolvedParamsRequest($this->request->get()), // data
                    ['button_title' => lang('messages.back'), 'url' => "/company/create"]
                );

            }
        }

        $this->view->render('company.create', ['company' => $result]);
    }


    public function edit($id)
    {
        $company = $this->CompanyModel->findById($id);
        $employees = $this->EmployeeModel->find(['conditions' => ['company_id' => $id]]);

        if ($this->request->isPut() && !$this->request->get('@InfoPage')) {
            if($this->update($id)) {
                infoView(
                    ['title' => 'Updated', 'data' => lang('messages.updated')],
                    [/* data */], 
                    ['button_title' => lang('messages.back'), 'url' => "/company/$id/edit"]
                );

            } else {

                errorView(
                    ['title' => 'Can not update', 'data' => implode('<br>',$this->CompanyModel->getValidationErrors())],
                    $this->resolvedParamsRequest($this->request->get()), // data
                    ['button_title' => lang('messages.back'), 'url' => "/company/$id/edit"]
                );

            }

        } elseif ($this->request->get('@ErrorPage')) {
            $company = $this->CompanyModel->assign($this->request->get())->toDataObject();
            $company->id = $id;
        }

        $this->view->render('company.edit', ['company' => $company, 'employees' => $employees]);
    }

    public function update($id)
    {
        $this->CompanyModel->assign($this->request->get());
        $this->CompanyModel->id = $id;
        return $this->CompanyModel->save();
    }

    public function destroy($id)
    {
        $employee = new Employee();
        $exist_company = $employee->findFirst(['conditions' => ['company_id' => $id]]);

        if (!$exist_company) {
            $this->CompanyModel->id = $id;
            if ($this->CompanyModel->delete(['conditions' => ['id' => $id]])) {

                infoView(
                    ['title' => 'Deleted', 'data' => lang('messages.deleted')],
                    [/* data */], 
                    ['button_title' => lang('messages.back'), 'url' => "/company"]
                );

            } else {

                errorView(
                    ['title' => 'Can not delete', 'data' => 'internal error!'],
                    [/* data */],
                    ['button_title' => lang('messages.back'), 'url' => "/company"]
                );

            }
        } else {
            errorView(
                ['title' => 'Can not delete', 'data' => 'Company are in used.'],
                [/* data */],
                ['button_title' => lang('messages.back'), 'url' => "/company"]
            );
        }
    }
}