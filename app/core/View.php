<?php

namespace App\Core;

use App\Core\FormHelper;

class View
{
    protected $_siteTitle = DEFAULT_SITETITLE;
    protected $_head;
    protected $_body;
    protected $_script;
    protected $_buffer;
    protected $_layout = DEFAULT_LAYOUT;

    public function render($viewName, $data = [])
    {
        $this->_render($viewName, $data);
    }

    public function messageRenderView($viewName, $message, $data = [], $backUrl = [], $type = 'info')
    {
        $this->_render(
            $viewName, 
            [
                'message_title' => $message['title'],
                'input_contents' => FormHelper::generateHiddenInput($data, $backUrl, $type),
                'message' => $message['data']
            ]
        );
    }

    private function _render($viewName, $data = [])
    {
        if (count($data)) { extract($data); }

        $viewName = str_replace(['.', '/'], [DS], $viewName);
        $view_file_path = ROOT . DS . 'app' . DS . 'view' . DS . $viewName .'.php';
        $layout_file_path = ROOT . DS . 'app' . DS . 'view' . DS . 'layout' . DS . $this->_layout . '.php';
        if (file_exists ($view_file_path)) {
            include_once($view_file_path);
            if (file_exists($layout_file_path)) {
                include_once($layout_file_path);
            } else {
                errorLog('file layout does not exist!');
            }
        } else {
            errorLog("file view does not exist! : $view_file_path");
        }
    }

    public function content($type)
    {
        if ($type == 'head') {
            return $this->_head;
        } elseif ($type == 'body') {
            return $this->setCsrfInput($this->_body);
        } elseif ($type == 'script') {
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
        if ($this->_buffer == 'head') {
            $this->_head = ob_get_clean();
        } elseif ($this->_buffer == 'body') {
            $this->_body =ob_get_clean();
        } elseif ($this->_buffer == 'script') {
            $this->_script = ob_get_clean();
        } else {
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