<?php

namespace App\Core;

class Controller extends Application
{
    protected $view;
 
    protected function __construct()
    {
        parent::__construct();
        $this->view = new View();
    }

    public function responseJson($statusCode, $success, $data, $message = '')
    {
        $response = ['success' => $success, 'data' => $data ];
        $response = strlen(trim($message)) > 0 ? array_merge($response, ['message'=>$message]) : $response;
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        http_response_code($statusCode);
        echo json_encode($response);
        exit;
    }

}