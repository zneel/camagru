<?php

use Camagru\Services\Router\Router;

require __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../config/database.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
$router = new Router($_GET['url']);
$router->get('/', 'DefaultController@indexAction');
$router->get('/register', 'AuthController@getRegisterPageAction');
$router->post('/register', 'AuthController@postRegisterAction');
$router->get('/login', 'AuthController@getLoginPageAction');
$router->post('/login', 'AuthController@postLoginAction');
$router->run();