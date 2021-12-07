<?php
declare(strict_types=1);

session_start();

use Democvidev\ChessTeam\Core\Router;
use Democvidev\ChessTeam\Model\CategoriesManager;
use Democvidev\ChessTeam\Database\DataBaseConnection;
use Democvidev\ChessTeam\Exception\NotFoundException;

require '../vendor/autoload.php';

define(
    'VIEWS',
    dirname(__DIR__) . DIRECTORY_SEPARATOR . 'vue' . DIRECTORY_SEPARATOR
);
define('SCRIPTS', dirname($_SERVER['SCRIPT_NAME']) . DIRECTORY_SEPARATOR);
define('DB_HOST', 'localhost');
define('DB_NAME', 'team_chess');
define('DB_USER', 'root');
define('DB_PASSWORD', '');

$db = new DataBaseConnection();
$categoryManager = new CategoriesManager($db);
$allCategories = $categoryManager->showAllCategory();
global $allCategories;

$router = new Router($_GET['action']);

$router
    ->get('/', 'Democvidev\ChessTeam\Controller\HomeController@index')
    ->get('/posts', 'Democvidev\ChessTeam\Controller\PostController@index')
    ->get('/posts/:id', 'Democvidev\ChessTeam\Controller\PostController@show')
    ->get(
        '/category/:id/posts',
        'Democvidev\ChessTeam\Controller\PostController@showCategoryPosts'
    )
    ->get(
        '/categories',
        'Democvidev\ChessTeam\Controller\CategoryController@index'
    )
    ->get(
        '/categories/:id',
        'Democvidev\ChessTeam\Controller\CategoryController@show'
    )
    ->get('/coachs', 'Democvidev\ChessTeam\Controller\CoachController@index')
    ->get('/coachs/:id', 'Democvidev\ChessTeam\Controller\CoachController@show')
    ->get('/coachs/map', 'Democvidev\ChessTeam\Controller\CoachController@map')

    ->get('/admin/posts', 'Democvidev\ChessTeam\Controller\Admin\PostController@index')
    // TODO: ne pas mettre en production qu'après les validations faites !
    ->post('/admin/posts/delete/:id', 'Democvidev\ChessTeam\Controller\Admin\PostController@destroy')
    ->get('/admin/posts/edit/:id', 'Democvidev\ChessTeam\Controller\Admin\PostController@edit')
    ->post('/admin/posts/edit/:id', 'Democvidev\ChessTeam\Controller\Admin\PostController@update');

// on ratrappe les erreurs personnalisées dans le cas où l'action n'existe pas
try {
    $router->run();
} catch (NotFoundException $e) {
    $e->error_404($e->getMessage());
}
