<?php
declare(strict_types=1);

session_start();

use Democvidev\ChessTeam\Core\Router;
use Democvidev\ChessTeam\Database\DataBaseConnection;
use Democvidev\ChessTeam\Model\CategoriesManager;


require '../vendor/autoload.php';

define('VIEWS', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'vue' . DIRECTORY_SEPARATOR);
define('SCRIPTS', dirname($_SERVER['SCRIPT_NAME']) . DIRECTORY_SEPARATOR);
$db = new DataBaseConnection();
$categoryManager = new CategoriesManager($db);
$allCategories = $categoryManager->showAllCategory();
global $allCategories;


$router = new Router($_GET['action']);

$router
    ->get('/', 'Democvidev\ChessTeam\Controller\HomeController@index')
    ->get('/posts', 'Democvidev\ChessTeam\Controller\PostController@index')
    ->get('/posts/:id', 'Democvidev\ChessTeam\Controller\PostController@show')
    ->get('/category/:id/posts', 'Democvidev\ChessTeam\Controller\PostController@showCategoryPosts')
    ->get('/categories', 'Democvidev\ChessTeam\Controller\CategoryController@index')
    ->get('/categories/:id', 'Democvidev\ChessTeam\Controller\CategoryController@show')
    ->run();

