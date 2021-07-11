<?php 
require_once('App\Lib\Dev.php');
use App\Core\Router;
$basic = function ($classname) {
    $file = __DIR__.DIRECTORY_SEPARATOR.$classname.'.php';
    if (file_exists($file)) {
    require_once($file);
    }
};
spl_autoload_register($basic);
session_start();

$router = new Router;
$router->run();