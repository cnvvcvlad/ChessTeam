<?php

namespace Democvidev\ChessTeam\Controller;

use Democvidev\ChessTeam\Model\CommentsManager;
use Democvidev\ChessTeam\Controller\AbstractController;

class CommentController extends AbstractController
{
    private $commentManager;

    public function __construct()
    {
        $this->commentManager = new CommentsManager($this->getDatabase());
    }

    /**
     * Récupère les commentaires d'un article
     * 
     * @param int $article_id
     * @return array
     */
    function getAllCommentsOfArticle($article_id): array
    {
        $comments = $this->commentManager->showCommentsOfArticle($article_id);
        return $comments;
    }

    /**
     * Récuère tous les commentaires
     *
     * @return array
     */
    function getAllComments(): array
    {
        $comments = $this->commentManager->allComments();
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
        $comment = $this->commentManager->commentId($comment_id);
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
        $this->commentManager->deleteCom($comment_id);
        header('location:index.php?action=allComments');
        exit();
    }
}
