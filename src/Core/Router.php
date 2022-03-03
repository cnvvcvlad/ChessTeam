<?php

namespace Democvidev\ChessTeam\Core;

use Democvidev\ChessTeam\Core\Route;
use Democvidev\ChessTeam\Form\PostForm;
use Democvidev\ChessTeam\Form\CoachForm;
use Democvidev\ChessTeam\Form\CommentForm;
use Democvidev\ChessTeam\Form\ContactForm;
use Democvidev\ChessTeam\Form\CategoryForm;
use Democvidev\ChessTeam\Form\RegisterForm;
use Democvidev\ChessTeam\Service\RoleHandler;
use Democvidev\ChessTeam\Form\AuthenticationForm;
use Democvidev\ChessTeam\Controller\PostController;
use Democvidev\ChessTeam\Controller\UserController;
use Democvidev\ChessTeam\Controller\CoachController;
use Democvidev\ChessTeam\Exception\NotFoundException;
use Democvidev\ChessTeam\Controller\CommentController;
use Democvidev\ChessTeam\Controller\CategoryController;

class Router
{
    public $url;
    public $routes = [];
    // private $path;
    // private $user;
    // private $post;
    // private $coco;
    // private $comment;
    // private $category;
    // private $role;

    public function __construct($url)
    {
        $this->url = trim($url, '/');
        // $this->path = dirname(__DIR__);
        // $this->user = new UserController();
        // $this->post = new PostController();
        // $this->coco = new CoachController();
        // $this->comment = new CommentController();
        // $this->category = new CategoryController();
        // $this->role = new RoleHandler();
    }

    public function get(string $path, string $action)
    {
        // on stock la route dans un tableau avec la clé GET
        $this->routes['GET'][] = new Route($path, $action);
        return $this;
    }

    public function post(string $path, string $action)
    {
        // on stocke les routes dans un tableau avec la clé POST
        $this->routes['POST'][] = new Route($path, $action);
        return $this;
    }

    public function run()
    {
        foreach ($this->routes[$_SERVER['REQUEST_METHOD']] as $route) {
            if ($route->matches($this->url)) {
                return $route->execute();
            }
        }
        // si aucune route ne correspond, on affiche la page d'erreur 404
        // return header('HTTP/1.0 404 Not Found');
        // throw new \Exception('Page not found', 404);
        throw new NotFoundException('Error : Page not found', 404);
    }
}
