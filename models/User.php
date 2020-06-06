<?php

namespace app\models;

use app\core\Model;
use app\config\Database;

class User extends Model
{
    public function validate($login, $password)
    {
        $errors = ['flag'=>true];

        if (empty($login) || $login == ''){$errors['login_error'] = 'Login is required'; $errors['flag'] = false; }
        if (empty($password) || $password == ''){$errors['password_error'] = 'Password is required'; $errors['flag'] = false; }
        return $errors;
    }
    public function getUserByLogin($login)
    {
        $sql = "SELECT * FROM users WHERE login ='".$login."'";
        $req = Database::connectDb()->prepare($sql);
        $req->execute();
        return $req->fetch();
    }
}
?>
