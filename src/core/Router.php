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
        $this->routes['GET'][] = new Route($path, $action);
        return $this;
    }

    public function run()
    {
        foreach($this->routes[$_SERVER['REQUEST_METHOD']] as $route) {
            if($route->matches($this->url)) {
                return $route->execute();
            }
        }
        // si aucune route ne correspond, on affiche la page d'erreur 404
        // return header('HTTP/1.0 404 Not Found');
        // throw new \Exception('Page not found', 404);
        throw new NotFoundException('Error : Page not found', 404);
    }

    public function run_old()
    {
        /****************** Pagination ***********************/
        // on détermine sur quelle page on se trouve
        if (isset($_GET['page']) && !empty($_GET['page'])) {
            // typage de la variable entière
            $currentPage = (int) strip_tags($_GET['page']);
        } else {
            $currentPage = 1;
        }
        // Nombre total d'articles
        $nbArticles = $this->post->getNbArticles();
        // Nombre d'articles par page
        $nbArticlesPerPage = 1;
        // Nombre de pages total
        $nbPages = ceil($nbArticles / $nbArticlesPerPage);
        // Calcul du premier article de la page à afficher
        $firstArticle = ($currentPage - 1) * $nbArticlesPerPage;

        try {
            $allCategory = $this->category->getAllCategory();
            $allArticles = $this->post->getListe(
                $firstArticle,
                $nbArticlesPerPage
            );
            $lastArticles = $this->post->getLastArticles();
            $lastArticle_one = $this->post->getLastArticle_one();

            $action = isset($_GET['action'])
                ? htmlspecialchars($_GET['action'])
                : 'home';
            if ($action == 'home') {
                require 'vue/vueAccueil.php';
            } elseif ($action == 'inscription') {
                require 'vue/vueInscription.php';
            } elseif ($action == 'connexion') {
                require 'vue/vueConnexion.php';
            } elseif ($action == 'postForm') {
                require $this->path . '/../src/form/PostForm.php';
                $postForm = new PostForm();
                $postForm->postForm();
            } elseif ($action == 'commentForm') {
                require $this->path . '/../src/form/CommentForm.php';
                $commentForm = new CommentForm();
                $commentForm->commentForm();
            } elseif ($action == 'coachForm') {
                require $this->path . '/../src/form/CoachForm.php';
                $coachForm = new CoachForm();
                $coachForm->coachForm();
            } elseif ($action == 'contactForm') {
                require $this->path . '/../src/form/ContactForm.php';
                $form = new ContactForm();
                $form->contactForm();
            } elseif ($action == 'registerForm') {
                require $this->path . '/../src/form/RegisterForm.php';
                $form = new RegisterForm();
                $form->registerForm();
            } elseif ($action == 'authenticationForm') {
                require $this->path . '/../src/form/AuthenticationForm.php';
                $form = new AuthenticationForm();
                $form->authenticationForm();
            } elseif ($action == 'categoryForm') {
                require $this->path . '/../src/form/CategoryForm.php';
                $form = new CategoryForm();
                $form->categoryForm();
            } elseif ($action == 'connected') {
                require 'vue/vueAccueil.php';
            } elseif ($action == 'myAccount') {
                if (isset($_SESSION['id_user'])) {
                    $myAccount = $this->user->getInfoUser(
                        htmlspecialchars($_SESSION['id_user'])
                    );
                    require 'vue/vueMember.php';
                }
            } elseif ($action == 'myArticlesId') {
                if (isset($_GET['idAuthor'])) {
                    $myArticles = $this->post->getMyArticles(
                        htmlspecialchars($_GET['idAuthor'])
                    );
                } else {
                    $myArticles = $this->post->getMyArticles(
                        htmlspecialchars($_SESSION['id_user'])
                    );
                }
                require 'vue/vueArticleId.php';
            } elseif ($action == 'createArticleId') {
                require $this->path . '/../vue/vueCreateArticleId.php';
            } elseif ($action == 'rss') {
                require 'vue/fluxRSS/rss.php';
            } elseif ($action == 'coach') {
                if (isset($_GET['id_coach'])) {
                    $coach = $this->coco->getCoach(
                        htmlspecialchars($_GET['id_coach'])
                    );
                    require 'vue/vueCoachInfo.php';
                } else {
                    $coachs = $this->coco->getTopCoachs();
                    require 'vue/vueCoachIndex.php';
                }
            } elseif ($action == 'streetMap') {
                require 'vue/vueStreetMap.php';
            } elseif ($action == 'apiStreetMap') {
                // $coordinateAdress = getCoordinateAdress(htmlspecialchars($_GET['ville']));
                $this->coco->getAllCoordinateAdress();
            } elseif ($action == 'allArticles') {
                if (isset($_GET['id'])) {
                    $commentsOfArticle = $this->comment->getAllCommentsOfArticle(
                        htmlspecialchars($_GET['id'])
                    );
                    $articleId = $this->post->getOneArticle(
                        htmlspecialchars($_GET['id'])
                    );
                    require $this->path . '/../vue/vueOneArticle.php';
                } elseif (isset($_GET['deleteA'])) {
                    $this->post->deleteMyArticle(
                        htmlspecialchars($_GET['deleteA'])
                    );
                } elseif (isset($_GET['updateA'])) {
                    $articleId = $this->post->getOneArticle(
                        htmlspecialchars($_GET['updateA'])
                    );

                    require 'vue/vueUpdateArticle.php';
                } else {
                    require $this->path . '/../vue/vueArticle.php';
                }
            } elseif ($action == 'allMembers') {
                if (isset($_GET['memberId'])) {
                    $myAccount = $this->user->getInfoUser(
                        htmlspecialchars($_GET['memberId'])
                    );
                    require 'vue/vueMember.php';
                } elseif (isset($_GET['deleteM'])) {
                    $this->user->deleteUser(htmlspecialchars($_GET['deleteM']));
                } else {
                    $allMembers = $this->user->getAllMembers();
                    require 'vue/vueAllMembers.php';
                }
            } elseif ($action == 'allCategory') {
                if (isset($_GET['deleteC'])) {
                    $this->category->deleteCategory(
                        htmlspecialchars($_GET['deleteC'])
                    );
                } elseif (empty($_GET['id'])) {
                    $allCategory = $this->category->getAllCategory();
                    require 'vue/vueAllCategory.php';
                }
            } elseif ($action == 'categoryId') {
                if (isset($_GET['id'])) {
                    $CategoryId = $this->category->getCategory(
                        htmlspecialchars($_GET['id'])
                    );
                    require 'vue/vueCategoryId.php';
                }
            } elseif ($action == 'articlesOfCategory') {
                if (isset($_GET['id'])) {
                    $articlesOfCategory = $this->post->getArticlesOfCategory(
                        htmlspecialchars($_GET['id'])
                    );
                    require 'vue/vueArticlesCategory.php';
                }
            } elseif ($action == 'allComments') {
                if (isset($_GET['modifyC'])) {
                    $modifyComment = $this->comment->getComment(
                        htmlspecialchars($_GET['modifyC'])
                    );
                    require 'vue/vueCommentId.php';
                } elseif (isset($_GET['deleteCom'])) {
                    $this->comment->deleteComment(
                        htmlspecialchars($_GET['deleteCom'])
                    );
                } else {
                    $allComments = $this->comment->getAllComments();
                    require 'vue/vueAllComments.php';
                }
            } elseif ($action == 'allVs') {
                require 'vue/vueAllVs.php';
            } elseif ($action == 'home') {
                require 'vue/vueAccueil.php';
            } elseif ($action == 'search') {
                if (isset($_POST['search']) && empty($_POST['search'])) {
                    header(
                        'location:./index.php?action=home&alert=emptySearch'
                    );
                    exit();
                } elseif (isset($_POST['search']) && !empty($_POST['search'])) {
                    $searchResults = $this->post->getPostsSearchResults(
                        htmlspecialchars($_POST['search'])
                    );
                }
                require 'vue/vueSearch.php';
            } elseif ($action == 'conditions') {
                require 'vue/vueConditions.php';
            } elseif ($action == 'mentions') {
                require 'vue/vueMentions.php';
            } elseif ($action == 'contact') {
                require 'vue/vueContact.php';
            } elseif ($action == 'questions') {
                require 'vue/vueQuestions.php';
            } elseif ($action == 'deconnect') {
                session_destroy();
                header('location:./');
                exit();
            } else {
                require 'vue/vueAccueil.php';
                exit();
            }
        } catch (\Exception $e) {
            $ex = 'Erreur : ' . $e->getMessage();
            require 'vue/vueException.php';
        }
    }
}
