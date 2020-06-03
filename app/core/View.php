<?php

namespace App\Core;

class View
{
    protected $_siteTitle;
    protected $_header;
    protected $_body;
    protected $_script;
    protected $_buffer;
    protected $_layout;

    protected function render($viewName)
    {

    }

    public function content($type)
    {
        if ($type == 'head')
        {
            return $this->_header;
        }
        elseif ($type == 'body')
        {
            return $this->setCsrfInput($this->_body);
        }
        elseif ($type == 'script')
        {
            return $this->_script;
        }
        return false;
    }

    public function start($type)
    {
        $this->_buffer = $type;
        ob_start();
    }

    public function end()
    {
        if ($this->_buffer == 'head')
        {
            $this->_head = ob_get_clean();
        }
        elseif ($this->_buffer == 'body')
        {
            $this->_body =ob_get_clean();
        }
        elseif ($this->_buffer == 'script')
        {
            $this->_script = ob_get_clean();
        }
        else
        {
            errorLog('you must run method start first.');
        }
    }

    public function setCsrfInput($contentPage)
    {
        $contentPage = preg_replace("/(<[fF][oO][rR][mM][^>]*>)/", "\\1".FormHelper::tokenInput(), $contentPage);
        return $contentPage;
    }


    public function insert($view_path)
    {
        include ROOT . DS .'app'. DS .'view'. DS . $view_path .'.php';
    }

    public function fragement($group, $fragement)
    {
        include ROOT . DS .'app'. DS .'view'. DS . $group . DS . $fragement .'.php';
    }

    public function setSiteTitle($value='')
    {
        $this->_siteTitle = $value;
    }

    public function setLayout($value='')
    {
        $this->_layout = $value;
    }
}