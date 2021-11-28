<?php
session_start();

require 'vendor/autoload.php';

use Democvidev\ChessTeam\Service\RoleHandler;
use Democvidev\ChessTeam\Controller\PostController;
use Democvidev\ChessTeam\Controller\UserController;
use Democvidev\ChessTeam\Controller\CoachController;
use Democvidev\ChessTeam\Controller\CommentController;
use Democvidev\ChessTeam\Controller\CategoryController;

/***************** Controllers & Helpers ***********************/
require_once 'src/controller/PostController.php';
require_once 'src/controller/CategoryController.php';
require_once 'src/controller/UserController.php';
require_once 'src/controller/CommentController.php';
require_once 'src/controller/CoachController.php';
require_once 'src/service/RoleHandler.php';

/******** Instanciation ************/
$user = new UserController();
$post = new PostController();
$category = new CategoryController();
$comment = new CommentController();
$role = new RoleHandler();
$coco = new CoachController();

/****************** Pagination ***********************/
// on détermine sur quelle page on se trouve
if (isset($_GET['page']) && !empty($_GET['page'])) {
    // typage de la variable entière
    $currentPage = (int) strip_tags($_GET['page']);
} else {
    $currentPage = 1;
}
// Nombre total d'articles
$nbArticles = $post->getNbArticles();
// Nombre d'articles par page
$nbArticlesPerPage = 1;
// Nombre de pages total
$nbPages = ceil($nbArticles / $nbArticlesPerPage);
// Calcul du premier article de la page à afficher
$firstArticle = ($currentPage - 1) * $nbArticlesPerPage;

/***************************************/

try {
    $allCategory = $category->getAllCategory();
    $allArticles = $post->getListe($firstArticle, $nbArticlesPerPage);
    $lastArticles = $post->getLastArticles();
    $lastArticle_one = $post->getLastArticle_one();

    if (isset($_GET['action'])) {
        $action = htmlspecialchars($_GET['action']);

        if ($action == 'inscription') {
            require 'vue/vueInscription.php';
        } elseif ($action == 'connexion') {
            require 'vue/vueConnexion.php';
        } elseif ($action == 'controllerFrontEnd') {
            require 'src/controller/controllerFrontEnd.php';
        } elseif ($action == 'controllerForm') {
            require 'src/controller/controllerForm.php';
        } elseif ($action == 'connected') {
            require 'vue/vueAccueil.php';
        } elseif ($action == 'myAccount') {
            if (isset($_SESSION['id_user'])) {
                $myAccount = $user->getInfoUser(
                    htmlspecialchars($_SESSION['id_user'])
                );
                require 'vue/vueMember.php';
            }
        } elseif ($action == 'myArticlesId') {
            if (isset($_GET['idAuthor'])) {
                $myArticles = $post->getMyArticles(
                    htmlspecialchars($_GET['idAuthor'])
                );
            } else {
                $myArticles = $post->getMyArticles(
                    htmlspecialchars($_SESSION['id_user'])
                );
            }
            require 'vue/vueArticleId.php';
        } elseif ($action == 'createArticleId') {
            require 'vue/vueCreateArticleId.php';
        } elseif ($action == 'rss') {
            require 'vue/fluxRSS/rss.php';
        } elseif ($action == 'coach') {
            if (isset($_GET['id_coach'])) {
                $coach = $coco->getCoach(htmlspecialchars($_GET['id_coach']));
                require 'vue/vueCoachInfo.php';
            } else {
                $coachs = $coco->getTopCoachs();
                require 'vue/vueCoachIndex.php';
            }
        } elseif ($action == 'streetMap') {
            require 'vue/vueStreetMap.php';
        } elseif ($action == 'apiStreetMap') {
            // $coordinateAdress = getCoordinateAdress(htmlspecialchars($_GET['ville']));
            $coco->getAllCoordinateAdress();
        } elseif ($action == 'allArticles') {
            if (isset($_GET['id'])) {
                $commentsOfArticle = $comment->getAllCommentsOfArticle(
                    htmlspecialchars($_GET['id'])
                );
                $articleId = $post->getOneArticle(htmlspecialchars($_GET['id']));
                require 'vue/vueOneArticle.php';
            } elseif (isset($_GET['deleteA'])) {
                $post->deleteMyArticle(htmlspecialchars($_GET['deleteA']));
            } elseif (isset($_GET['updateA'])) {
                $articleId = $post->getOneArticle(htmlspecialchars($_GET['updateA']));

                require 'vue/vueUpdateArticle.php';
            } else {
                require 'vue/vueArticle.php';
            }
        } elseif ($action == 'allMembers') {
            if (isset($_GET['memberId'])) {
                $myAccount = $user->getInfoUser(
                    htmlspecialchars($_GET['memberId'])
                );
                require 'vue/vueMember.php';
            } elseif (isset($_GET['deleteM'])) {
                $user->deleteUser(htmlspecialchars($_GET['deleteM']));
            } else {
                $allMembers = $user->getAllMembers();
                require 'vue/vueAllMembers.php';
            }
        } elseif ($action == 'allCategory') {
            if (isset($_GET['deleteC'])) {
                $category->deleteCategory(htmlspecialchars($_GET['deleteC']));
            } elseif (empty($_GET['id'])) {
                $allCategory = $category->getAllCategory();
                require 'vue/vueAllCategory.php';
            }
        } elseif ($action == 'categoryId') {
            if (isset($_GET['id'])) {
                $CategoryId = $category->getCategory(htmlspecialchars($_GET['id']));
                require 'vue/vueCategoryId.php';
            }
        } elseif ($action == 'articlesOfCategory') {
            if (isset($_GET['id'])) {
                $articlesOfCategory = $post->getArticlesOfCategory(
                    htmlspecialchars($_GET['id'])
                );
                require 'vue/vueArticlesCategory.php';
            }
        } elseif ($action == 'allComments') {
            if (isset($_GET['modifyC'])) {
                $modifyComment = $comment->getComment(htmlspecialchars($_GET['modifyC']));
                require 'vue/vueCommentId.php';
            } elseif (isset($_GET['deleteCom'])) {
                $comment->deleteComment(htmlspecialchars($_GET['deleteCom']));
            } else {
                $allComments = $comment->getAllComments();
                require 'vue/vueAllComments.php';
            }
        } elseif ($action == 'allVs') {
            require 'vue/vueAllVs.php';
        } elseif ($action == 'home') {
            require 'vue/vueAccueil.php';
        } elseif ($action == 'search') {
            if (isset($_POST['search']) && empty($_POST['search'])) {
                header('location:./index.php?action=home&alert=emptySearch');
                exit();
            } elseif (isset($_POST['search']) && !empty($_POST['search'])) {
                $searchResults = $post->getPostsSearchResults(
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
    } else {
        require 'vue/vueAccueil.php';
        exit();
    }
} catch (Exception $e) {
    $ex = 'Erreur : ' . $e->getMessage();
    require 'vue/vueException.php';
}
