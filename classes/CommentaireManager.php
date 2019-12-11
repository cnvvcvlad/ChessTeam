<?php

require_once 'model/DataBase.php';

class CommentaireManager extends DataBase
{

    public function ShowCommentsOfArticle($article_id)
    {
        $request = 'SELECT * FROM comments WHERE article_id = :article_id';
        $select = $this->dbConnect()->prepare($request);
        $select->execute(["article_id" => $article_id]);
        $comments = [];

        while ($data = $select->fetch()) {
            $comments[] = new Comment($data);
        }
        return $comments;
    }

    public  function  allComments() {
        $request = 'SELECT * FROM comments ORDER BY id DESC';
        $select = $this->dbConnect()->prepare($request);
        $select->execute();

        $comments = [];

        while ($data = $select->fetch()) {
            $comments[] = new Comment($data);
        }
        return $comments;
    }

    public function commentId($id) {
        $request = 'SELECT * FROM comments WHERE id = :id';
        $select = $this->dbConnect()->prepare($request);
        $select->execute(["id" => $id]);

        $comment[] = new Comment($select->fetch());
        return $comment;
    }

    public function deleteCom($id) {
        $request = 'DELETE FROM comments WHERE id = :id';
        $delete = $this->dbConnect()->prepare($request);
        $delete->execute(["id" => $id]);
        return;
    }

}