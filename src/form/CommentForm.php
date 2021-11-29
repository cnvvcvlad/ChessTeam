<?php

namespace Democvidev\ChessTeam\Form;

use Democvidev\ChessTeam\Classes\Comment;
use Democvidev\ChessTeam\Model\CommentsManager;

class CommentForm
{
    private $manager_comment;

    public function __construct()
    {
        $this->manager_comment = new CommentsManager();
    }

    public function commentForm()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['updateComment'])) {
                extract($_POST);
                $id = htmlspecialchars($id);
                $com_content = htmlspecialchars($com_content);
                $this->manager_comment->updateComment(
                    $id,
                    new Comment([
                        'com_content' => $com_content,
                    ])
                );
                header('location:index.php?action=allComments');
                exit();
            } elseif (
                isset($_POST['commentCreation'])
            ) {
                $com_author = htmlspecialchars($_SESSION['id_user']);
                $com_content = htmlspecialchars($_POST['com_content']);
                $article_id = htmlspecialchars($_POST['article_id']);
                $this->manager_comment->insertComment(
                    new Comment([
                        'com_author' => $com_author,
                        'com_content' => $com_content,
                        'article_id' => $article_id,
                    ])
                );
                header('location:./' . basename($_SERVER['HTTP_REFERER']));
                exit();
            }
        }
    }
}
