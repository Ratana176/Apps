<?php

namespace App\Core;

class Controller extends Application
{
    protected $view;
    /**
     * to reset value from page
     */
    protected $_special_variable = ['@method', '@ErrorPage', '@InfoPage', '@csrf_token'];
 
    protected function __construct()
    {
        parent::__construct();
        $this->view = new View();
    }

    /**
     * Create new model object using name of Model
     * @param $model model's name
     * @return Object model class
     */
    protected function loadModel($model)
    {
        $model_path = "App\Model\\".$model;
        if (class_exists($model_path)) $this->{$model . 'Model'} = new $model_path();
    }

    /**
     * The resolved the post values from the error page or info page
     * @param array $param the value from page.
     * @return array that remove $_special_variable
     */
    protected function resolvedParamsRequest($param)
    {
        return array_reduce($this->_special_variable, function ($init, $key) use(&$param){
            if (array_key_exists($key, $param)) {
                unset($param[$key]);
            }
            return $param;
        }, []);
    }

    /**
     * respone json daata
     * @param int $statusCode response status code to client
     * @param boolean $success tell client if success or not
     * @param array | object $data data passed to client
     * @param string $message the message to client what's going on.
     * @return string
     */
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