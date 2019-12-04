<?php


function getListe()
{
    $art_manager = new PostsManager();
    $posts = $art_manager->Affichage();
    return $posts;

}

function getLastArticles()
{
    $art_manager = new PostsManager();
    $posts = $art_manager->Affichage_recentes();
    return $posts;
}

function getLastArticle_one()
{
    $art_manager = new PostsManager();
    $post = $art_manager->Affichage_last_one();
    return $post;
}

function getArticlesOfCategory($category_id)
{
    $art_manager = new PostsManager();
    $posts = $art_manager->AffichageParCategorie($category_id);
    return $posts;
}

function getOneArticle($art_id)
{
    $art_manager = new PostsManager();
    $post = $art_manager->Affichage_one($art_id);
    return $post;
}

function isAuthor($art_author)
{
    if (isset($_SESSION['id_user'])) {
        $art_manager = new PostsManager();
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
    $art_manager = new PostsManager();
    $posts = $art_manager->AffichageMyArticles($id_user);
    return $posts;
}

function deleteMyArticle($id_article)
{
    $art_manager = new PostsManager();
    $art_manager->deleteArticle($id_article);
    header('location:index.php?action=allArticles');
    return;
}

function updateMyArticle($id_article) {
    $art_manager = new PostsManager();
    $art_manager->updateArticle($id_article);
    return;
}