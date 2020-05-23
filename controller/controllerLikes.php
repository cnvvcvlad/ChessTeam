<?php

function getAllLikesOfArticle($article_id)
{
    $like_manager = new LikesManager();
    $likes = $like_manager->nbLikesOfArticle($article_id);
//    var_dump($likes);
    return $likes;
}

function isLikedByUser($id_user, $article_id)
{
    $like_manager = new LikesManager();
    $like_author = $like_manager->isLiked($id_user, $article_id);

    return $like_author;
}

function registerLike($id_user, $article_id)
{
    $like_manager = new LikesManager();
    $like = $like_manager->addLike($id_user, $article_id);
    return $like;
}

function deleteLike($like){
    $like_manager = new LikesManager();
    $like_manager->supprimerLike($like);
    return;
}