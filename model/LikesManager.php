<?php

require_once 'DataBase.php';

class LikesManager extends DataBase {

    public function getDataBase(){
        return $this->dataBase;
    }

    public function setDataBase($dataBase){
        $this->dataBase = $dataBase;
    }

    public function nbLikesOfArticle($article_id){
//        $query = 'SELECT COUNT(likes_id) AS likes FROM articles_likes WHERE articles_id = :article_id';
        $query = 'SELECT COUNT(like_article) AS likes FROM likes WHERE like_article = :article_id';

        $select = $this->dbConnect()->prepare($query);
        $select->execute(["article_id" => $article_id]);

        $like = $select->fetch();
//        var_dump($like);
        return $like;
    }

    public function isLiked($id_user, $article_id){
//        $query = 'SELECT DISTINCT likes_id FROM articles_likes INNER JOIN likes WHERE like_author = :id_user AND articles_id = :article_id';
        $query = 'SELECT like_author FROM likes WHERE like_author = :id_user AND like_article = :article_id';

        $select = $this->dbConnect()->prepare($query);
        $select->execute([
           "id_user" => $id_user,
           "article_id" => $article_id
        ]);
        $like = $select->fetch();

        return $like;
    }


    public function addLike(Users $id_user, Article $article_id){
        $request = 'INSERT INTO likes(like_author, like_article) VALUES(:id_user, :article_id)';
        $insert = $this->dbConnect()->prepare($request);
        $insert = $insert->execute([
            'like_author' => $id_user->getId_user(),
            'like_article' => $article_id->getId()
        ]);
    }

    public function supprimerLike($like){
        $query = 'DELETE FROM likes WHERE id = :id_like';
        $delete = $this->dbConnect()->prepare($query);
        $delete->execute(['id_like' => $like]);
        return;
    }

}
