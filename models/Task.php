<?php

namespace app\models;

use app\core\Model;
use app\config\Database;

class Task extends Model
{

    public function validate($user_name,$email, $description)
    {
        $errors = ['flag'=>true];

        if (empty($user_name) || $user_name == ''){$errors['user_name_error'] = 'User name is required'; $errors['flag'] = false; }
        if (empty($description) || $description == ''){$errors['description_error'] = 'Description is required';  $errors['flag'] = false; }
        if (empty($email) || $email == ''){$errors['email_error'] = 'Email address is required';  $errors['flag'] = false; }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)){$errors['email_error'] = 'Email address is not valid';  $errors['flag'] = false; }
        return $errors;
    }

    public function save($user_name,$email, $description)
    {
        $sql = "INSERT INTO tasks (user_name, email, description) VALUES (:user_name, :email, :description)";

        $req = Database::connectDb()->prepare($sql);

        return $req->execute([
            'user_name' => $user_name,
            'description' => $description,
            'email' => $email,
        ]);
    }

    public function getTask($id)
    {
        $sql = "SELECT * FROM tasks WHERE id =" . $id;
        $req = Database::connectDb()->prepare($sql);
        $req->execute();
        return $req->fetch();
    }
    public function getTaskCount($search = null)
    {
        if ($search == null){
            $sql = "SELECT COUNT(*) As tasks_count FROM `tasks`";
        }else{
            $sql = "SELECT COUNT(*) As tasks_count FROM tasks WHERE ";
            foreach ($search as $key => $val){
                $sql.= str_replace('search_','', $key)." like '".$val."' and ";
            }
            $sql = substr($sql,0,-4);
        }
        $req = Database::connectDb()->prepare($sql);
        $req->execute();
        return $req->fetch();
    }

    public function getAllTasks($search = null,$offset = null,$total_per_page = null)
    {
        if ($search == null){
            $sql = "SELECT * FROM tasks ";
        }else{
            $sql = "SELECT * FROM tasks WHERE ";
            foreach ($search as $key => $val){
                $sql.= str_replace('search_','', $key)." like '".$val."' and ";
            }
            $sql = substr($sql,0,-4);
        }
        if ($offset !== null && $total_per_page !== null){
            $sql.= " LIMIT ".$offset." , ".$total_per_page;
        }
        $req = Database::connectDb()->prepare($sql);
        $req->execute();
        return $req->fetchAll();
    }

    public function update($id, $user_name, $email, $description,$done)
    {
        if(!self::validate($user_name,$email, $description)){return false;}

        $sql = "UPDATE tasks SET user_name = :user_name, description = :description , email = :email,done = :done WHERE id = :id";
        $req = Database::connectDb()->prepare($sql);
        return $req->execute([
            'id' => $id,
            'user_name' => $user_name,
            'description' => $description,
            'email' => $email,
            'done' => $done,
        ]);
    }

    public function delete($id)
    {
        $sql = 'DELETE FROM tasks WHERE id = ?';
        $req = Database::connectDb()->prepare($sql);
        return $req->execute([$id]);
    }
}
?>
