<?php

require_once 'DataBase.php';

class CommentsManager extends DataBase
{
    public function getDataBase()
    {
        return $this->dataBase;
    }

    public function setDataBase($dataBase)
    {

        $this->dataBase = $dataBase;
    }


    public function insertComment(Comment $comment)
    {
        $request = 'INSERT INTO comments(com_author, com_content, article_id) VALUES(:com_author, :com_content, :article_id)';
        $insert = $this->dbConnect()->prepare($request);
        $insert = $insert->execute([
            'com_author' => $comment->getCom_author(),
            'com_content' => $comment->getCom_content(),
            'article_id' => $comment->getArticle_id()
        ]);
    }

    public function updateComment($id, Comment $comment) {
        $request = 'UPDATE comments SET com_content = :com_content WHERE id =:id';
        $update = $this->dbConnect()->prepare($request);
        $update = $update->execute([
            'id' => $id,
            'com_content' => $comment->getCom_content()
        ]);
    }

    public function Affichage()
    {
        $query = 'SELECT * FROM articles ORDER BY id DESC';
        $select = $this->dbConnect()->prepare($query);
        $select->execute();

        $art = [];

        while ($donnees = $select->fetch()) {
            $art[] = new Article($donnees);
        }
        return $art;
    }

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