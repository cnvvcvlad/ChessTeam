<?php

require_once 'model/DataBase.php';

class PostsManager extends DataBase
{
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


    public function Affichage_recentes()
    {
        $query = 'SELECT * FROM articles WHERE id > 40 ORDER BY id DESC LIMIT 5 ';
        $select = $this->dbConnect()->prepare($query);
        $select->execute();

        $art = [];

        while ($donnees = $select->fetch()) {
            $art[] = new Article($donnees);
        }
        // var_dump($art);
        return $art;
    }

    public function Affichage_last_one()
    {
        $query = 'SELECT * FROM articles WHERE id = 40';
        $select = $this->dbConnect()->prepare($query);
        $select->execute();
        $art[] = new Article($select->fetch());
        return $art;
    }

    public function AffichageParCategorie($category_id)
    {
        $query = 'SELECT * FROM articles WHERE category_id = :category_id';
        $select = $this->dbConnect()->prepare($query);
        $select->execute(["category_id" => $category_id]);

        $art = [];

        while ($data = $select->fetch()) {
            $art[] = new Article($data);
        }

        return $art;
    }

    public function Affichage_one($art_id)
    {
        $query = 'SELECT * FROM articles WHERE id = :art_id';
        $select = $this->dbConnect()->prepare($query);
        $select->execute(["art_id" => $art_id]);

        $art[] = new Article($select->fetch());
        return $art;
    }

    public function AffichageMyArticles($id_user)
    {
        $query = 'SELECT * FROM articles WHERE art_author = :id_user';
        $select = $this->dbConnect()->prepare($query);
        $select->execute(["id_user" => $id_user]);

        $art = [];

        while ($data = $select->fetch()) {
            $art[] = new Article($data);
        }
        return $art;
    }

    public function deleteArticle($id_article)
    {
        $query = 'DELETE FROM articles WHERE id = :id_article';
        $delete = $this->dbConnect()->prepare($query);
        $delete->execute(["id_article" => $id_article]);
        return;
    }

}
