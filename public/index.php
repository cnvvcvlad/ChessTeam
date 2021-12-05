<?php

use Democvidev\ChessTeam\Core\Router;

session_start();

require '../vendor/autoload.php';

define('VIEWS', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'vue' . DIRECTORY_SEPARATOR);
define('SCRIPTS', dirname($_SERVER['SCRIPT_NAME']) . DIRECTORY_SEPARATOR);

$router = new Router($_GET['action']);

$router
    ->get('/', 'Democvidev\ChessTeam\Controller\HomeController@index')
    ->get('/posts/:id', 'Democvidev\ChessTeam\Controller\PostController@show')
    ->run();

// require_once dirname(__DIR__) . '/src/core/Router.php';
// use Democvidev\ChessTeam\Core\Router;

// $router = new Router();
// $router->run();