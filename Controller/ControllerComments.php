<?php

namespace Democvidev\App;

class ControllerComments {

    
    public
    function getAllCommentsOfArticle($article_id) {
        $comment_manager = new CommentsManager();
        $comments = $comment_manager->showCommentsOfArticle($article_id);
        return $comments;
    }
    
    public
    function numberCommentsOfArticle($commentsOfArticle) {
        echo count($commentsOfArticle);
    }
    
    public
    function getAllComments() {
        $comment_manager = new CommentsManager();
        $comments = $comment_manager->allComments();
        return $comments;
    }
    
    public
    function getComment($comment_id) {
        $comment_manager = new CommentsManager();
        $comment = $comment_manager->commentId($comment_id);
        return $comment;
    }
    
    public
    function deleteComment($comment_id) {
        $comment_manager = new CommentsManager();
        $comment_manager->deleteCom($comment_id);
        header('location:index.php?action=allComments');
    }
}