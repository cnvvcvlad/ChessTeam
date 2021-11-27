<?php

class CommentController
{
    // public function __construct()
    // {
    //     $this->commentModel = new CommentModel();
    //     $this->commentView = new CommentView();
    // }

    /**
     * Récupère les commentaires d'un article
     * 
     * @param int $article_id
     * @return array
     */
    function getAllCommentsOfArticle($article_id): array
    {
        $comment_manager = new CommentsManager();
        $comments = $comment_manager->showCommentsOfArticle($article_id);
        return $comments;
    }

    
    // function numberCommentsOfArticle($commentsOfArticle): void
    // {
    //     echo count($commentsOfArticle);
    // }

    /**
     * Récuère tous les commentaires
     *
     * @return array
     */
    function getAllComments(): array
    {
        $comment_manager = new CommentsManager();
        $comments = $comment_manager->allComments();
        return $comments;
    }

    /**
     * Récupère un seul commentaire en fonction de son id
     *
     * @param int $comment_id
     * @return array
     */
    function getComment($comment_id): array
    {
        $comment_manager = new CommentsManager();
        $comment = $comment_manager->commentId($comment_id);
        return $comment;
    }

    /**
     * Supprime un commentaire en fonction de son id
     *
     * @param int $comment_id
     * @return void
     */
    function deleteComment($comment_id): void
    {
        $comment_manager = new CommentsManager();
        $comment_manager->deleteCom($comment_id);
        header('location:index.php?action=allComments');
        exit();
    }
}
