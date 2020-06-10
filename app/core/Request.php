<?php

namespace App\Core;

class Request
{
    private $methodSupported = ['POST', 'GET', 'PUT', 'DELETE', ''];

    public function isGet()
    {
        return $this->getRequestMethod() == 'GET';
    }

    public function isPost()
    {
        $method = strtoupper($this->get('@method'));
        if ( $method != 'POST' && $method != '') return false;
        return $this->getRequestMethod() == 'POST';
    }

    public function isPut()
    {
        if ($this->getRequestMethod() == 'POST' && strtoupper($this->get('@method')) == 'PUT') {
            return true;
        }
        return $this->getRequestMethod() == 'PUT';
    }

    public function isDelete()
    {
        if ($this->getRequestMethod() == 'POST' && strtoupper($this->get('@method')) == 'DELETE') {
            return true;
        }
        return $this->getRequestMethod() == 'DELETE';
    }

    /**
     * To handle the value that request by user from http methods
     * to avoid XXS or SQL injections
     * @param string $input the name of variable.
     * @return string value that sanitized. 
     */
    public function get($input = false)
    {
        if (!$input) {
            $data = [];
            foreach ($_REQUEST as $field => $value) {
                $data[$field] = self::sanitize($value);
            }
            return $data;
        }
        return isset($_REQUEST[$input]) ? self::sanitize($_REQUEST[$input]) : null;
    }

    /**
     * To treat the form what is the method is going to use.
     * @param $methodName the name of the method
     * @return string hidden input that contain http methods.
     */
    public function method($methodName)
    {
        if (in_array(strtoupper($methodName), $this->methodSupported)) {
            return Dom::input(['type' => 'hidden', 'id' => '@method', 'name' => '@method', 'value' => $methodName]);
        } else {
            return 'method not supported!';
        }
    }

    public static function sanitize($value)
    {
        return htmlentities($value, ENT_QUOTES, 'UTF-8');
    }

    public function getRequestMethod()
    {
        return strtoupper($_SERVER['REQUEST_METHOD']);
    }


}
