<?php

session_start();

require 'vendor/autoload.php';

// spl_autoload_register(function ($class) {
//     require 'classes/' . $class . '.php';
// });

/****************************************/
// require 'Controller/controllerStatut.php';
// require 'Controller/ControllerPosts.php';
// require 'Controller/ControllerCategory.php';
// require 'Controller/controllerUser.php';
// require 'Controller/controllerComments.php';

require 'Model/ArticleManager.php';
require 'Model/CategoriesManager.php';
require 'Model/CommentsManager.php';
require 'Model/MemberManager.php';

use Democvidev\App\ControllerCategory;
use Democvidev\App\ControllerPosts;
use Democvidev\App\ControllerComments;
use Democvidev\App\ControllerUser;

/*****************************************/


try {
    $allCategory = ControllerCategory::getAllCategory();
    $allArticles = ControllerPosts::getListe();
    $lastArticles = ControllerPosts::getLastArticles();
    $lastArticle_one = ControllerPosts::getLastArticle_one();

    if (isset($_GET['action'])) {
        $action = htmlspecialchars($_GET['action']);

        if ($action == 'inscription') {
            require 'vue/vueInscription.php';
        } elseif ($action == 'connexion') {
            require 'vue/vueConnexion.php';
        } elseif ($action == 'connected') {
            require 'vue/vueAccueil.php';
        } elseif ($action == 'myAccount') {
            if (isset($_SESSION['id_user'])) {
                $myAccount = ControllerUser::getInfoUser(htmlspecialchars($_SESSION['id_user']));
                require 'vue/vueMember.php';
            }
        } elseif ($action == 'myArticlesId') {
            if (isset($_GET['idAuthor'])) {
                $myArticles = ControllerPosts::getMyArticles(htmlspecialchars($_GET['idAuthor']));
            } else {
                $myArticles = ControllerPosts::getMyArticles(htmlspecialchars($_SESSION['id_user']));
            }
            require 'vue/vueArticleId.php';
        } elseif ($action == 'createArticleId') {
            require 'vue/vueCreateArticleId.php';
        } elseif ($action == 'allArticles') {
            if (isset($_GET['id'])) {
                $commentsOfArticle = ControllerComments::getAllCommentsOfArticle(htmlspecialchars($_GET['id']));
                $articleId = ControllerPosts::getOneArticle(htmlspecialchars($_GET['id']));
                require 'vue/vueOneArticle.php';
            } elseif (isset($_GET['deleteA'])) {
                ControllerPosts::deleteMyArticle(htmlspecialchars($_GET['deleteA']));
            } elseif (isset($_GET['updateA'])) {
                $articleId = ControllerPosts::getOneArticle(htmlspecialchars($_GET['updateA']));

                require 'vue/vueUpdateArticle.php';
            } else {
                require 'vue/vueArticle.php';
            }
        } elseif ($action == 'allMembers') {
            if (isset($_GET['memberId'])) {
                $myAccount = ControllerUser::getInfoUser(htmlspecialchars($_GET['memberId']));
                require 'vue/vueMember.php';
            } elseif (isset($_GET['deleteM'])) {
                ControllerUser::deleteUser(htmlspecialchars($_GET['deleteM']));
            } else {
                $allMembers = ControllerUser::getAllMembers();
                require 'vue/vueAllMembers.php';
            }
        } elseif ($action == 'allCategory') {
            if (isset($_GET['deleteC'])) {
                ControllerCategory::deleteCategory(htmlspecialchars($_GET['deleteC']));
            } elseif (empty($_GET['id'])) {
                $allCategory = ControllerCategory::getAllCategory();
                require 'vue/vueAllCategory.php';
            }
        } elseif ($action == 'categoryId') {
            if (isset($_GET['id'])) {
                $CategoryId = ControllerCategory::getCategory(htmlspecialchars($_GET['id']));
                require 'vue/vueCategoryId.php';
            }
        } elseif ($action == 'articlesOfCategory') {
            if (isset($_GET['id'])) {
                $articlesOfCategory = ControllerPosts::getArticlesOfCategory(htmlspecialchars($_GET['id']));
                require 'vue/vueArticlesCategory.php';
            }
        } elseif ($action == 'allComments') {
            if (isset($_GET['modifyC'])) {
                $modifyComment = ControllerComments::getComment(htmlspecialchars($_GET['modifyC']));
                require 'vue/vueCommentId.php';
            } elseif (isset($_GET['deleteCom'])) {
                ControllerComments::deleteComment(htmlspecialchars($_GET['deleteCom']));
            } else {
                $allComments = ControllerComments::getAllComments();
                require 'vue/vueAllComments.php';
            }
        } elseif ($action == 'allVs') {
            require 'vue/vueAllVs.php';
        } elseif ($action == 'home') {
            require 'vue/vueAccueil.php';
//            header('location:./');
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
} catch (\Exception $e) {
    $ex = 'Erreur : ' . $e->getMessage();
    require 'vue/vueException.php';
}
