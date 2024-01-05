<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
//on importe les namespaces l'autoloader et du router
use App\AutoLoader;
use App\Core\Router;

//on inclut l'autoloader
include '../Autoloader.php';
Autoloader::register();

//on instancie le routeur
$route = new Router();

//on lance l'application
$route->routes();
