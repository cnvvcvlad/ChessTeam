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
    // on affiche le formulaire de connexion
    ->get('/login', 'Democvidev\ChessTeam\Controller\UserController@login')
    // on traite le formulaire de connexion
    ->post('/login', 'Democvidev\ChessTeam\Controller\UserController@loginUser')
    ->get(
        '/register',
        'Democvidev\ChessTeam\Controller\UserController@register'
    )
    ->post(
        '/register',
        'Democvidev\ChessTeam\Controller\UserController@registerUser'
    )
    ->get('/logout', 'Democvidev\ChessTeam\Controller\UserController@logout')
    ->get('/profile', 'Democvidev\ChessTeam\Controller\UserController@profile')
    ->get(
        '/profile/update/:id',
        'Democvidev\ChessTeam\Controller\UserController@update'
    )
    ->post(
        '/profile/update/:id',
        'Democvidev\ChessTeam\Controller\UserController@updateUser'
    )
    ->post(
        '/profile/delete/:id',
        'Democvidev\ChessTeam\Controller\UserController@destroy'
    )
    ->get(
        '/profile/posts',
        'Democvidev\ChessTeam\Controller\PostController@profilePosts'
    )

    ->post('/search', 'Democvidev\ChessTeam\Controller\PostController@search')
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
    ->get(
        'admin/categories/create',
        'Democvidev\ChessTeam\Controller\Admin\CategoryController@create'
    )
    ->get(
        'admin/categories/edit/:id',
        'Democvidev\ChessTeam\Controller\Admin\CategoryController@edit'
    )
    ->get(
        'admin/categories',
        'Democvidev\ChessTeam\Controller\Admin\CategoryController@index'
    )
    ->post(
        'admin/categories/create-category',
        'Democvidev\ChessTeam\Controller\Admin\CategoryController@createCategory'
    )
    ->post(
        'admin/categories/update-category/:id',
        'Democvidev\ChessTeam\Controller\Admin\CategoryController@editCategory'
    )
    ->post(
        'admin/categories/delete/:id',
        'Democvidev\ChessTeam\Controller\Admin\CategoryController@delete'
    )

    ->get('/coachs', 'Democvidev\ChessTeam\Controller\CoachController@index')
    ->get('/coachs/:id', 'Democvidev\ChessTeam\Controller\CoachController@show')
    ->post('/coachs/map', 'Democvidev\ChessTeam\Controller\CoachController@map')

    ->get(
        '/api/coachs',
        'Democvidev\ChessTeam\Controller\CoachController@getAllCoordinateAdress'
    )

    ->get(
        '/admin/members',
        'Democvidev\ChessTeam\Controller\Admin\UserController@members'
    )

    ->get(
        '/admin/comments',
        'Democvidev\ChessTeam\Controller\Admin\CommentController@index'
    )
    ->get(
        '/admin/comments/edit/:id',
        'Democvidev\ChessTeam\Controller\Admin\CommentController@edit'
    )
    ->post(
        '/admin/comments/edit/:id',
        'Democvidev\ChessTeam\Controller\Admin\CommentController@update'
    )
    ->post(
        '/admin/comments/delete/:id',
        'Democvidev\ChessTeam\Controller\Admin\CommentController@destroy'
    )

    ->get(
        '/admin/posts',
        'Democvidev\ChessTeam\Controller\Admin\PostController@index'
    )
    // TODO: ne pas mettre en production qu'après les validations faites !
    ->post(
        '/admin/posts/delete/:id',
        'Democvidev\ChessTeam\Controller\Admin\PostController@destroy'
    )
    ->get(
        '/admin/posts/edit/:id',
        'Democvidev\ChessTeam\Controller\Admin\PostController@edit'
    )
    // on affiche le formulaire de création d'un nouveau post
    ->get(
        '/admin/posts/create',
        'Democvidev\ChessTeam\Controller\Admin\PostController@create'
    )
    // on enregistre le nouveau post
    ->post(
        '/admin/posts/create',
        'Democvidev\ChessTeam\Controller\Admin\PostController@createPost'
    )
    ->post(
        '/admin/posts/edit/:id',
        'Democvidev\ChessTeam\Controller\Admin\PostController@update'
    );

// on ratrappe les erreurs personnalisées dans le cas où l'action n'existe pas
try {
    $router->run();
} catch (NotFoundException $e) {
    $e->error_404($e->getMessage());
}
