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
    $post = $art_manager->affichageLastOne();
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
    $post = $art_manager->affichageOne($art_id);
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
    return $posts;
}

function deleteMyArticle($id_article)
{
    $art_manager = new ArticleManager();
    $art_manager->deleteArticle($id_article);
    header('location:index.php?action=allArticles');
}

