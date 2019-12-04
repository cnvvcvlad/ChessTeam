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
//        var_dump($comments);
        return $comments;
    }


}