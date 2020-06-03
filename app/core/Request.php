<?php

namespace App\Core;

class Request
{
    private $methodSupported = ['POST', 'GET', 'PUT', 'DELETE'];

    public function isGet()
    {
        return $this->getRequestMethod() == 'GET';
    }

    public function isPost()
    {
        $method = strtoupper($this->get('@method'));
        if (!in_array($method, $this->methodSupported)) return false;
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

    public function method($methodName)
    {
        if (in_array($methodName, $this->methodSupported)) {
            echo Dom::input(['type' => 'hidden', 'id' => '@method', 'name' => '@method', 'value' => $methodName]);
        } else {
            print_r('method not supported!');
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
