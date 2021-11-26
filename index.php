<?php
session_start();

spl_autoload_register(function ($class) {
    require 'classes/' . $class . '.php';
});

/****************************************/
require_once 'controller/controllerStatut.php';
require_once 'controller/controllerPosts.php';
require_once 'controller/controllerCategory.php';
require_once 'controller/controllerUser.php';
require_once 'controller/controllerComments.php';
require_once 'controller/controllerCoachs.php';

require_once 'model/ArticleManager.php';
require_once 'model/CategoriesManager.php';
require_once 'model/CommentsManager.php';
require_once 'model/MemberManager.php';
require_once 'model/CoachsManager.php';

/****************** Pagination ***********************/
// on détermine sur quelle page on se trouve
if(isset($_GET['page']) && !empty($_GET['page'])){
    // typage de la variable entière
    $currentPage = (int) strip_tags($_GET['page']);
}else{
    $currentPage = 1;
}
// Nombre total d'articles
$nbArticles = getNbArticles();
// Nombre d'articles par page
$nbArticlesPerPage = 1;
// Nombre de pages total
$nbPages = ceil($nbArticles / $nbArticlesPerPage);
// Calcul du premier article de la page à afficher
$firstArticle = ($currentPage - 1) * $nbArticlesPerPage;

/***************************************/

try {
    $allCategory = getAllCategory();
    $allArticles = getListe($firstArticle, $nbArticlesPerPage);    
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
                $myAccount = getInfoUser(
                    htmlspecialchars($_SESSION['id_user'])
                );
                require 'vue/vueMember.php';
            }
        } elseif ($action == 'myArticlesId') {
            if (isset($_GET['idAuthor'])) {
                $myArticles = getMyArticles(
                    htmlspecialchars($_GET['idAuthor'])
                );
            } else {
                $myArticles = getMyArticles(
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
                $coach = getCoach(htmlspecialchars($_GET['id_coach']));
                require 'vue/vueCoachInfo.php';
            } else {
                $coachs = getTopCoachs();
                require 'vue/vueCoachIndex.php';
            }
        } elseif ($action == 'streetMap') {
            require 'vue/vueStreetMap.php';
        } elseif ($action == 'apiStreetMap') {
            // $coordinateAdress = getCoordinateAdress(htmlspecialchars($_GET['ville']));
            getAllCoordinateAdress();
        } elseif ($action == 'allArticles') {
            if (isset($_GET['id'])) {
                $commentsOfArticle = getAllCommentsOfArticle(
                    htmlspecialchars($_GET['id'])
                );
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
                $articlesOfCategory = getArticlesOfCategory(
                    htmlspecialchars($_GET['id'])
                );
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
        } elseif ($action == 'search') {
            if (isset($_POST['search']) && empty($_POST['search'])) {
                header('location:./index.php?action=home&alert=emptySearch');
                exit();
            } elseif (isset($_POST['search']) && !empty($_POST['search'])) {
                $searchResults = getPostsSearchResults(htmlspecialchars($_POST['search']));
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
