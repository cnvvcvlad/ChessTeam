<?php


function getListe()
{
    $art_manager = new ArticleManager();
    $posts = $art_manager->affichageArt();
    return $posts;

}

function getLastArticles()
{
    $art_manager = new ArticleManager();
    $posts = $art_manager->affichageRecentes();
    return $posts;
}

function getLastArticle_one()
{
    $art_manager = new ArticleManager();

    if(!isConnected()){
        $post = $art_manager->showLastOne();
    } else {
        $post = $art_manager->affichageLastOne($_SESSION['id_user']);

        /** on verifie si l'user connecté a liké cet article ou non*/
        foreach ($post as $key => $value) {
            $like_manager = new LikesManager();
            $like_author = $like_manager->isLiked($_SESSION['id_user'], $value->getId());
//        var_dump($like_author['like_author']);
//        var_dump($id_user);


            if ($_SESSION['id_user'] == $like_author['like_author']) {
                $value->setIs_liked(true);
            } else {
                $value->setIs_liked(false);
            }
        }
    }

//var_dump($post);
//    exit();
    return $post;
}

function getArticlesOfCategory($category_id)
{
    $art_manager = new ArticleManager();
    $posts = $art_manager->affichageParCategorie($category_id);
    return $posts;
}

function getOneArticle($art_id)
{
    $art_manager = new ArticleManager();
    if (!isConnected()) {
        $post = $art_manager->affichageOne($art_id);
    }else {
        $post = $art_manager->affichageOne($art_id);

        /** on verifie si l'user connecté a liké cet article ou non*/
        foreach ($post as $key => $value) {
            $like_manager = new LikesManager();
            $like_author = $like_manager->isLiked($_SESSION['id_user'], $value->getId());
//        var_dump($like_author['like_author']);
//        var_dump($id_user);

            if ($_SESSION['id_user'] == $like_author['like_author']) {
                $value->setIs_liked(true);
            } else {
                $value->setIs_liked(false);
            }
        }
    }

//    var_dump($post);
//    exit();
    return $post;
}

function isAuthor($art_author)
{
    if (isset($_SESSION['id_user'])) {
        $art_manager = new ArticleManager();
        $art_manager = $art_manager->AffichageMyArticles($art_author);
        foreach ($art_manager as $key => $value) {
            $value->getArt_author();
        }
        if ($_SESSION['id_user'] == $value->getArt_author()) {
            return true;
        }
        return false;
    }
    return;
}

function getMyArticles($id_user)
{
    $art_manager = new ArticleManager();
    $posts = $art_manager->AffichageMyArticles($id_user);


    /** on verifie si l'user connecté a liké cet article ou non*/
    foreach ($posts as $key => $value) {
//    var_dump($value->getArt_author());
        $like_manager = new LikesManager();
        $like_author = $like_manager->isLiked($id_user, $value->getId());
//        var_dump($like_author['like_author']);
//        var_dump($id_user);


        if ($id_user == $like_author['like_author']) {
            $value->setIs_liked(true);
        } else {
            $value->setIs_liked(false);
        }
    }
//    var_dump($posts);
//    exit();
    return $posts;
}

function deleteMyArticle($id_article)
{
    $art_manager = new ArticleManager();
    $art_manager->deleteArticle($id_article);
    header('location:index.php?action=allArticles');
}



