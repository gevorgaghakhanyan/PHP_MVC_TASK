<?php

namespace app;

use Router;
use \app\Request;

class Dispatcher
{
    private $request;

    public function dispatch()
    {
        $this->request = new Request();
        Router::parse($this->request->url, $this->request);
        $controller = $this->loadController();
        call_user_func_array([$controller, $this->request->action], $this->request->params);
    }

    public function loadController()
    {
        $name = $this->request->controller . "Controller";
        $name = ucfirst($name);
        $file = ROOT . 'controllers/' . $name . '.php';
        require_once($file);
        $full_name = 'app\\controllers\\'.$name;
        $controller = new $full_name();
        return $controller;
    }
}
?>
