<?php

function getAllCommentsOfArticle($article_id) {
    $comment_manager = new CommentaireManager();
    $comments = $comment_manager->ShowCommentsOfArticle($article_id);
    return $comments;
}

function numberCommentsOfArticle($commentsOfArticle) {
    echo count($commentsOfArticle);
}

