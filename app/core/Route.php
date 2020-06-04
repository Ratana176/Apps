<?php

namespace App\Core;

class Route
{
    protected static $controller;
    protected static $action;
    protected static $action_name;
    protected static $params;
    protected static $queryString;
    protected static $url;

    private static $_request;
    private static $_postRequests = [];
    private static $_getRequests = [];
    private static $_putRequests = [];
    private static $_deleteRequests = [];

    public static function register($request)
    {
        self::$_request = $request;
        self::_setupRoute();
        self::_requestHandler();
    }

    public static function get($url , $callback) 
    {
        self::$_getRequests[$url] = $callback;
    }

    public static function post($url , $callback) 
    {
        self::$_postRequests[$url] = $callback;
    }

    public static function put($url , $callback) 
    {
        self::$_putRequests[$url] = $callback;
    }

    public static function delete($url , $callback) 
    {
        self::$_deleteRequests[$url] = $callback;
    }

    private static function _setupRoute()
    {
        $url = isset($_SERVER['PATH_INFO']) ? explode('/', ltrim($_SERVER['PATH_INFO'], '/')) : [];
        self::$url = $url;

        // controller
        self::$controller = !isset($url[0]) ? DEFAULT_CONTROLLER : (ucwords($url[0]) . 'Controller');
        array_shift($url);

        // action
        self::$action = !isset($url[0]) ? 'index' : $url[0];
        self::$action_name = self::$action . 'Action';
        array_shift($url);

        // parameter
        self::$params = !isset($url[0]) ? [] : $url;

        // Query String
        self::$queryString = !empty($_SERVER['QUERY_STRING']) ? explode('&', $_SERVER['QUERY_STRING']) : [];
    }

    private static function _requestHandler()
    {
        $request = self::$_request;

        if ($request->isGet()) {
            self::_getHandler();
        } elseif ($request->isPost()) {
            self::_postHandler();
        } elseif ($request->isPut()) {
            self::_putHandler();
        } elseif ($request->isDelete()) {
            self::_deleteHandler();
        } else {
            print_r('Not Supported Method!');
        }
    }

    private static function _getHandler()
    {
        
        self::_checkingRequest(self::$_getRequests);
    }

    private static function _postHandler()
    {
        
        self::_checkingRequest(self::$_postRequests);
    }

    private static function _putHandler()
    {
        
        self::_checkingRequest(self::$_putRequests);
    }

    private static function _deleteHandler()
    {
        self::_checkingRequest(self::$_deleteRequests);
    }

    private static function _checkingRequest($requests)
    {

        $respone = array_reduce(array_keys($requests), function($init, $key) use ($requests) {
            // $request = $requests[$key];
            // print_r(self::$controller );
            // if(is_string($request) && (self::$controller . '@' . self::$action) == $request) {
            //     return true;
            // }
            /*
                callable fucntion not yet to implement
            */
            return false;
        }, '');

        if ($respone) {
            $controller_name = NAMESPACE_CONTROLLER . self::$controller;
            if (method_exists($controller_name, self::$action_name)) {
                $dispatch = new $controller_name();
                // to call fuction and pass param to function
                call_user_func_array([$dispatch, self::$action_name], self::$params);
            }
        } else {
            errorView(['title' => 'Page Not Found.', 'data' => '404 | Not Found'],[], '/', 'error');
        }
    }

    public static function redirect()
    {
        
    }

}