<?php

namespace Democvidev\ChessTeam\Controller\Admin;

use Democvidev\ChessTeam\Classes\Comment;
use Democvidev\ChessTeam\Model\CommentsManager;
use Democvidev\ChessTeam\Controller\AbstractController;

class CommentController extends AbstractController
{
    private $commentManager;

    public function __construct()
    {
        $this->commentManager = new CommentsManager($this->getDatabase());
    }

    public function index()
    {
        $this->isAdmin();
        $comments = $this->commentManager->allComments();
        $this->view('admin.comments.index', [
            'comments' => $comments
        ]);
    }

    public function edit($id)
    {
        $this->isAdmin();
        return $this->view('admin.comments.form', [
            'comment' => $this->commentManager->commentId($id)
        ]);
    }

    public function update($id)
    {
        $this->isAdmin();       
        if(!empty($_POST) && isset($_POST['updateComment'])) {

            extract($_POST);
            $result = $this->commentManager->updateComment($id, new Comment([
                'com_content' => $com_content,
            ]));
            if ($result) {
                return header('Location:' . dirname(SCRIPTS) . '/admin/comments');
            }
        }
    }

    public function destroy($id)
    {
        $this->isAdmin();
        $this->commentManager->deleteCom($id);
        return header('Location:' . dirname(SCRIPTS) . '/admin/comments');
    }
}