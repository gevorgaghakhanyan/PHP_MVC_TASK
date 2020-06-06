<?php

namespace app\controllers;

use app\core\Controller;
use app\models\User;

class UsersController extends Controller
{

    function index()
    {
        if (isset($_POST["login"])){
            require(ROOT . 'models/User.php');
            $users = new User();
            $validation_errors = $users->validate($_POST["login"],$_POST["password"]);
            if($validation_errors['flag']){
                $user = $users->getUserByLogin($_POST['login']);
                if (!empty($user) && $user != false){
                    if ($user['password'] == $_POST["password"]){
                        $is_logged = true;
                        $_SESSION['is_logged'] = $is_logged;
                        header("Location: " . WEBROOT);
                    }else{
                        $validation_errors['password_error'] = 'Password is incorrect';
                        $data['errors'] = $validation_errors;
                        $data['par'] = $_POST;
                        $this->setParams($data);
                    }
                }else{

                    $validation_errors['login_error'] = 'Login is incorrect';
                    $data['errors'] = $validation_errors;
                    $data['par'] = $_POST;
                    $this->setParams($data);
                }
            }else{
                $data['errors'] = $validation_errors;
                $data['par'] = $_POST;
                $this->setParams($data);
            }
        }
        $this->render("index");
    }
    function log_out()
    {
        $_SESSION['is_logged'] = false;
        header("Location: " . WEBROOT);
    }
}
?>
