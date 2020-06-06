<?php

namespace app\web;

use app\Dispatcher;

define('WEBROOT', str_replace("web/index.php", "", $_SERVER["SCRIPT_NAME"]));
define('ROOT', str_replace("web/index.php", "", $_SERVER["SCRIPT_FILENAME"]));

require(ROOT . '/config/web.php');
require(ROOT . '/router.php');
require(ROOT . '/request.php');
require(ROOT . '/dispatcher.php');

session_start();

$dispatch = new Dispatcher();
$dispatch->dispatch();
?>
