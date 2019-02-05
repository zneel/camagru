<?php

use Camagru\Services\Router\Router;

require __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../config/database.php';

$router = new Router();
$router->add('', ['controller' => 'DefaultController', 'action' => 'index']);

$router->dispatch($_SERVER['QUERY_STRING']);
