<?php

namespace Democvidev\App;

require_once 'DataBase.php';

use Democvidev\App\Category;

class CategoriesManager extends DataBase
{

    public function getDataBase()
    {
        return $this->dataBase;
    }

    public function setDataBase($dataBase)
    {
        $this->dataBase = $dataBase;
    }


    public function insertCategory(Category $category)
    {
        $request = 'INSERT INTO category(title, description, category_image, cat_author) VALUES(:cat_title, :cat_description, :cat_image, :cat_author)';
        $insert = $this->dbConnect()->prepare($request);
        $insert = $insert->execute([
            'cat_title' => $category->getTitle(),
            'cat_description' => $category->getDescription(),
            'cat_image' => $category->getCategory_image(),
            'cat_author' => $category->getCat_author()
        ]);
    }

    public function updateCategory($id, Category $category)
    {
        $request = 'UPDATE category SET title = :title, description = :description, category_image = :category_image, cat_author = :cat_author WHERE id = :id ';
        $update = $this->dbConnect()->prepare($request);
        $update = $update->execute([
            'id' => $id,
            'title' => $category->getTitle(),
            'description' => $category->getDescription(),
            'category_image' => $category->getCategory_image(),
            'cat_author' => $category->getCat_author()
        ]);
    }


    public function showAllCategory()
    {
        $request = 'SELECT *, DATE_FORMAT(cat_date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS cat_date_creation FROM category';
        $select = $this->dbConnect()->prepare($request);
        $select->execute();

        $cat = [];

        while ($data = $select->fetch()) {
            $cat[] = new Category($data);
        }
        return $cat;
    }

    public function showCategory($id_category)
    {
        $request = 'SELECT *, DATE_FORMAT(cat_date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS cat_date_creation FROM category WHERE id = :id';
        $select = $this->dbConnect()->prepare($request);
        $select->execute(["id" => $id_category]);

        $cat = [];

        while ($data = $select->fetch()) {
            $cat[] = new Category($data);
        }
        return $cat;
    }

    public function nameCategory($id_category)
    {
        $request = 'SELECT title FROM category WHERE id = :id';
        $select = $this->dbConnect()->prepare($request);
        $select->execute(["id" => $id_category]);

        $cat =$select->fetch();
        return $cat;

    }

    public function deleteCat($id_category) {
        $request = 'DELETE FROM category WHERE id = :id';
        $delete = $this->dbConnect()->prepare($request);
        $delete->execute(["id" => $id_category]);
    }
}