<?php

namespace app\controllers;

use app\core\Controller;
use app\models\Task;

class TasksController extends Controller
{

    function index($params = 'index_action')
    {
        require(ROOT . 'models/Task.php');
        $tasks = new Task();
        $search = '';
        $model['search'] = null;
        $page_no = 1;
        if (isset($_GET['page_no'])){
            $page_no = $_GET['page_no'];
        }
        $offset = ($page_no-1) * 3;
        if (isset($_POST["search_user_name"]) && $_POST["search_user_name"] != ''){$model['search']['search_user_name'] = $_POST["search_user_name"];}
        if (isset($_POST["search_email"]) && $_POST["search_email"] != ''){$model['search']['search_email'] = $_POST["search_email"];}
        if (isset($_POST["search_done"]) && $_POST["search_done"] != ''){$model['search']['search_done'] = $_POST["search_done"]; }

        $model['tasks'] = $tasks->getAllTasks($model['search'],$offset,3);
        $model['tasks_count'] = $tasks->getTaskCount($model['search']);
        $this->setParams($model);
        $this->render("index");
    }

    function create($params = 'create_action')
    {
        if (isset($_POST["user_name"]))
        {
            require(ROOT . 'models/Task.php');
            $task= new Task();
            $validation_errors = $task->validate($_POST["user_name"],$_POST["email"], $_POST["description"]);
            if($validation_errors['flag']){
                if ($task->save($_POST["user_name"],$_POST["email"], $_POST["description"]))
                {
                    header("Location: " . WEBROOT);
                }
            }else{
                $data['errors'] = $validation_errors;
                $data['par'] = $_POST;
                $this->setParams($data);
            }
        }
        $this->render("create");
    }

    function update($id)
    {
        require(ROOT . 'models/Task.php');
        $task= new Task();

        $data["task"] = $task->getTask($id);

        if (isset($_POST["user_name"]))
        {
            $validation_errors = $task->validate($_POST["user_name"],$_POST["email"], $_POST["description"]);
            if($validation_errors['flag']){
                if ($task->update($id,$_POST["user_name"],$_POST["email"], $_POST["description"], $_POST["done"]))
                {
                    header("Location: " . WEBROOT);
                }
            }else{
                $data['errors'] = $validation_errors;
                $this->setParams($data);
            }
        }
        $this->setParams($data);
        $this->render("update");
    }

    function delete($id)
    {
        require(ROOT . 'models/Task.php');

        $task = new Task();
        if ($task->delete($id))
        {
            header("Location: " . WEBROOT);
        }
    }
}
?>
