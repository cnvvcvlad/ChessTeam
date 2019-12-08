<?php
require_once 'model/DataBase.php';

class CategoryManager extends DataBase
{
    public function ShowAllCategory()
    {
        $request = 'SELECT * FROM category';
        $select = $this->dbConnect()->prepare($request);
        $select->execute();

        $cat = [];

        while ($data = $select->fetch()) {
            $cat[] = new Category($data);
        }
        return $cat;
    }

    public function ShowCategory($id_category)
    {
        $request = 'SELECT * FROM category WHERE id = :id';
        $select = $this->dbConnect()->prepare($request);
        $select->execute(["id" => $id_category]);

        $cat[] = new Category($select->fetch());
        return $cat;

    }

    public function nameCategory($id_category)
    {
        $request = 'SELECT title FROM category WHERE id = :id';
        $select = $this->dbConnect()->prepare($request);
        $select->execute(["id" => $id_category]);

        $cat = $select->fetch();
        return $cat;

    }

    public function deleteC($id_category) {
        $request = 'DELETE FROM category WHERE id = :id';
        $delete = $this->dbConnect()->prepare($request);
        $delete->execute(["id" => $id_category]);
    }
}