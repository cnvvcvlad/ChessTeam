<?php

session_start();
require 'vendor/autoload.php';

// spl_autoload_register(function ($class) {
//     require 'classes/' . $class . '.php';
// });

/****************************************/
require 'controller/controllerStatut.php';
require 'controller/controllerPosts.php';
require 'controller/controllerCategory.php';
require 'controller/controllerUser.php';
require 'controller/controllerComments.php';

require 'model/ArticleManager.php';
require 'model/CategoriesManager.php';
require 'model/CommentsManager.php';
require 'model/MemberManager.php';

/*****************************************/


try {
    $allCategory = getAllCategory();
    $allArticles = getListe();
    $lastArticles = getLastArticles();
    $lastArticle_one = getLastArticle_one();

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
                $myAccount = getInfoUser(htmlspecialchars($_SESSION['id_user']));
                require 'vue/vueMember.php';
            }
        } elseif ($action == 'myArticlesId') {
            if (isset($_GET['idAuthor'])) {
                $myArticles = getMyArticles(htmlspecialchars($_GET['idAuthor']));
            } else {
                $myArticles = getMyArticles(htmlspecialchars($_SESSION['id_user']));
            }
            require 'vue/vueArticleId.php';
        } elseif ($action == 'createArticleId') {
            require 'vue/vueCreateArticleId.php';
        } elseif ($action == 'allArticles') {
            if (isset($_GET['id'])) {
                $commentsOfArticle = getAllCommentsOfArticle(htmlspecialchars($_GET['id']));
                $articleId = getOneArticle(htmlspecialchars($_GET['id']));
                require 'vue/vueOneArticle.php';
            } elseif (isset($_GET['deleteA'])) {
                deleteMyArticle(htmlspecialchars($_GET['deleteA']));
            } elseif (isset($_GET['updateA'])) {
                $articleId = getOneArticle(htmlspecialchars($_GET['updateA']));

                require 'vue/vueUpdateArticle.php';
            } else {
                require 'vue/vueArticle.php';
            }
        } elseif ($action == 'allMembers') {
            if (isset($_GET['memberId'])) {
                $myAccount = getInfoUser(htmlspecialchars($_GET['memberId']));
                require 'vue/vueMember.php';
            } elseif (isset($_GET['deleteM'])) {
                deleteUser(htmlspecialchars($_GET['deleteM']));
            } else {
                $allMembers = getAllMembers();
                require 'vue/vueAllMembers.php';
            }
        } elseif ($action == 'allCategory') {
            if (isset($_GET['deleteC'])) {
                deleteCategory(htmlspecialchars($_GET['deleteC']));
            } elseif (empty($_GET['id'])) {
                $allCategory = getAllCategory();
                require 'vue/vueAllCategory.php';
            }
        } elseif ($action == 'categoryId') {
            if (isset($_GET['id'])) {
                $CategoryId = getCategory(htmlspecialchars($_GET['id']));
                require 'vue/vueCategoryId.php';
            }
        } elseif ($action == 'articlesOfCategory') {
            if (isset($_GET['id'])) {
                $articlesOfCategory = getArticlesOfCategory(htmlspecialchars($_GET['id']));
                require 'vue/vueArticlesCategory.php';
            }
        } elseif ($action == 'allComments') {
            if (isset($_GET['modifyC'])) {
                $modifyComment = getComment(htmlspecialchars($_GET['modifyC']));
                require 'vue/vueCommentId.php';
            } elseif (isset($_GET['deleteCom'])) {
                deleteComment(htmlspecialchars($_GET['deleteCom']));
            } else {
                $allComments = getAllComments();
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
} catch (Exception $e) {
    $ex = 'Erreur : ' . $e->getMessage();
    require 'vue/vueException.php';
}
