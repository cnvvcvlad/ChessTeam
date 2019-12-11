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


}