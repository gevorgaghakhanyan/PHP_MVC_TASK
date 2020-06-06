<?php

namespace app\core;

class Controller
{
    public $params = [];
    public $layout = "main";

    function __construct()
    {

    }

    public function setParams($vars)
    {
        $this->params = array_merge($this->params, $vars);
    }

    public function render($action)
    {
        extract($this->params);
        ob_start();
        require(ROOT . "views/" . strtolower(str_replace('Controller', '', str_replace('app\controllers\\','',get_class($this))))) . '/' . $action . '.php';
        $content_for_layout = ob_get_clean();

        if ($this->layout == false)
        {
            $content_for_layout;
        }
        else
        {
            require(ROOT . "views/layouts/" . $this->layout . '.php');
        }
    }
}
?>
