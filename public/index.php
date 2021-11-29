<?php

session_start();

require 'vendor/autoload.php';

require_once dirname(__DIR__) . '/src/core/Router.php';
use Democvidev\ChessTeam\Core\Router;

$router = new Router();
$router->run();