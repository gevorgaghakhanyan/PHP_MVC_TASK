<?php

class Router
{
    static public function parse($url, $request)
    {
//        var_dump($url);die();
//        $url = str_replace('/web/','',$url);
        $explode_get_url = explode('?', $url);
        if (count($explode_get_url) > 1){
            $url = $explode_get_url[0];
        }
         if ($url == "/PHP_MVC_task/" || $url == "/PHP_MVC_task" || $url == "/index.php" || $url=='/') {
            $request->controller = "tasks";
            $request->action = "index";
            $request->params = [];
        } else {
            $url = trim($url);
            $explode_url = explode('/', $url);
            $explode_url = array_slice($explode_url, 1);
            $request->controller = $explode_url[0];
            if ($request->controller == 'index.php'){$request->controller = "tasks";}
            $request->action = $explode_url[1];
            $request->params = array_slice($explode_url, 2);
        }
    }
}
?>
