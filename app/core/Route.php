<?php

namespace App\Core;

class Route
{
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
        self::$url = isset($_SERVER['PATH_INFO']) ? explode('/', ltrim($_SERVER['PATH_INFO'], '/')) : [];

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
        
        $request_to = '';
        $response = [];
        $variables = [];
        $request_routes = array_diff(self::$url, ['']); // to remove empty array that mean / path.
        $request_routes_count = count($request_routes);
        if ($request_routes_count == 0) {
            $request_to = $requests['/'] ?? '';
            $response[] = true;
        } else {
            foreach ($requests as $url_path => $controller_action) {
                $register_routes = array_diff(explode('/', ltrim($url_path, '/')), ['']); // to remove empty array that mean / path.
                if (count($register_routes) == $request_routes_count) {
                    $passed = [];
                    foreach($register_routes as $index => $request_path) {
                        if ($request_path == $request_routes[$index]) {
                            $passed[] = true;
                        } elseif(preg_match('/\{(.*?)\}/', $request_path, $matche)) {
                            $variables [] = $matche[1];
                            $passed[] = true;
                        } else {
                            $passed[] = false;
                        }
                    }
                    if (!in_array(false, $passed)) {
                        $request_to = $controller_action;
                        $response[] = true;
                        break;
                    }
                } else {
                    $response[] = false;
                }
            }
        }
        if (in_array(true, $response)) {
            if (is_string($request_to) && strpos($request_to, '@')) {
                $controller_action = explode('@', $request_to);
                $controller_name = NAMESPACE_CONTROLLER . $controller_action[0];
                $action_name = $controller_action[1].'Action';
                if (method_exists($controller_name, $action_name)) {
                    $dispatch = new $controller_name();
                    // to call fuction and pass param to function
                    call_user_func_array([$dispatch, $action_name], $variables);
                } else {
                    errorView(
                        ['title' => 'Method Not Found.', 'data' => "Method $action_name does not found in class {$controller_action[0]}"],
                        [], // data
                        ['button_title' => 'Go back', 'url' => '/']
                    );
                }
            } elseif ( is_callable ($request_to)) {
                call_user_func_array($request_to, $variables);
            } else {
                errorView(
                    ['title' => 'Invalid Route', 'data' => "Please check your route configuration."],
                    [], // data
                    ['button_title' => 'Go back', 'url' => '/']
                );
            }
            
        } else {
            errorView(
                ['title' => 'Page Not Found.', 'data' => '404 | Not Found'],
                [], // data
                ['button_title' => 'Go back', 'url' => '/']
            );
        }

    }

    public static function redirect()
    {
        
    }

}