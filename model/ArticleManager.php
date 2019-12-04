<?php

require_once 'DataBase.php';

class ArticleManager extends DataBase {
    public function getDataBase() {
        return $this->dataBase;
    }

    public function setDataBase($dataBase)
    {
        $this->dataBase = $dataBase;
    }

    public function insertArticle(Article $article) {
        $request = 'INSERT INTO articles(art_title, art_description, art_content, art_image, art_author, category_id) VALUES(:art_title, :art_description, :art_content, :art_image, :art_author, :category_id)';
        $insert = $this->dbConnect()->prepare($request);
        $insert = $insert->execute([
            'art_title' => $article->getArt_title(),
            'art_description' => $article->getArt_description(),
            'art_content' => $article->getArt_content(),
            'art_image' => $article->getArt_image(),
            'art_author' => $article->getArt_author(),
            'category_id' => $article->getCategory_id()
        ]);

//        var_dump($article->getArt_author());
//        var_dump($article->getCategory_id());

        
    }

    public function updateArticle($id, Article $article) {
        $request = 'UPDATE articles SET art_title = :art_title, art_description = :art_description, art_content = :art_content, art_image = :art_image, art_author = :art_author, category_id = :category_id WHERE id =:id';
        $update = $this->dbConnect()->prepare($request);
        $update = $update->execute([
            'id' => $id,
            'art_title' => $article->getArt_title(),
            'art_description' => $article->getArt_description(),
            'art_content' => $article->getArt_content(),
            'art_image' => $article->getArt_image(),
            'art_author' => $article->getArt_author(),
            'category_id' => $article->getCategory_id()
        ]);
        return;
    }
    

}