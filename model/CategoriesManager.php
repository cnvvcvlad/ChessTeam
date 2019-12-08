<?php

require_once 'DataBase.php';

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
        return;
    }
}