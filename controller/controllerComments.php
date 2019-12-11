<?php

function getAllCommentsOfArticle($article_id) {
    $comment_manager = new CommentaireManager();
    $comments = $comment_manager->ShowCommentsOfArticle($article_id);
    return $comments;
}

function numberCommentsOfArticle($commentsOfArticle) {
    echo count($commentsOfArticle);
}

function getAllComments() {
    $comment_manager = new CommentaireManager();
    $comments = $comment_manager->allComments();
    return $comments;
}

function getComment($comment_id) {
    $comment_manager = new CommentaireManager();
    $comment = $comment_manager->commentId($comment_id);
    return $comment;
}

function deleteComment($comment_id) {
    $comment_manager = new CommentaireManager();
    $comment_manager->deleteCom($comment_id);
    header('location:index.php?action=allComments');
    return;
}