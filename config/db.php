<?php

namespace app\config;

use PDO;

class Database
{
    private static $db = null;

    private function __construct() {
    }

    public static function connectDb() {
        if(is_null(self::$db)) {
            self::$db = new PDO("mysql:host=localhost;dbname=to_do_list", 'root', 'root');
        }
        return self::$db;
    }
}
?>
