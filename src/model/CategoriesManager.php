<?php

namespace Democvidev\ChessTeam\Model;

use Democvidev\ChessTeam\Classes\Category;

class CategoriesManager extends DataBase
{
    /**
     * Insère une catégorie dans la base de données
     * 
     * @param Category $category
     * @return void
     */
    public function insertCategory(Category $category): void
    {
        $request = 'INSERT INTO category(title, description, category_image, cat_author) VALUES(:cat_title, :cat_description, :cat_image, :cat_author)';
        $insert = $this->dbConnect()->prepare($request);
        $insert->bindValue(':cat_title', $category->getTitle(), \PDO::PARAM_STR);
        $insert->bindValue(':cat_description', $category->getDescription(), \PDO::PARAM_STR);
        $insert->bindValue(':cat_image', $category->getCategory_image(), \PDO::PARAM_STR);
        $insert->bindValue(':cat_author', $category->getCat_author(), \PDO::PARAM_STR);
        $insert = $insert->execute();
    }

    /**
     * Met à jour une catégorie dans la base de données
     *
     * @param int $id
     * @param Category $category
     * @return void
     */
    public function updateCategory($id, Category $category): void
    {
        $request = 'UPDATE category SET title = :title, description = :description, category_image = :category_image, cat_author = :cat_author WHERE id = :id ';
        $update = $this->dbConnect()->prepare($request);
        $update->bindValue(':id', $id, \PDO::PARAM_INT);
        $update->bindValue(':title', $category->getTitle(), \PDO::PARAM_STR);
        $update->bindValue(':description', $category->getDescription(), \PDO::PARAM_STR);
        $update->bindValue(':category_image', $category->getCategory_image(), \PDO::PARAM_STR);
        $update->bindValue(':cat_author', $category->getCat_author(), \PDO::PARAM_STR);
        $update = $update->execute();
    }

    /**
     * Affichage de la liste des catégories
     *
     * @return array
     */
    public function showAllCategory(): array
    {
        $request = 'SELECT *, DATE_FORMAT(cat_date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS cat_date_creation FROM category';
        $select = $this->dbConnect()->query($request);
        $cat = [];
        while ($data = $select->fetch()) {
            $cat[] = new Category($data);
        }
        return $cat;
    }

    /**
     * Affichage d'une catégorie
     *
     * @param int $id_category
     * @return array
     */
    public function showCategory($id_category): array
    {
        $request = 'SELECT *, DATE_FORMAT(cat_date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS cat_date_creation FROM category WHERE id = :id';
        $select = $this->dbConnect()->prepare($request);
        $select->bindValue(':id', $id_category, \PDO::PARAM_INT);
        $select->execute();
        $cat = [];
        while ($data = $select->fetch()) {
            $cat[] = new Category($data);
        }
        return $cat;
    }

    /**
     * Retourne le titre d'une catégorie
     *
     * @param int $id_category
     * @return array
     */
    public function nameCategory($id_category): array
    {
        $request = 'SELECT title FROM category WHERE id = :id';
        $select = $this->dbConnect()->prepare($request);
        $select->bindValue(':id', $id_category, \PDO::PARAM_INT);
        $select->execute();
        $cat =$select->fetch();
        return $cat;
    }

    /**
     * Supprime une catégorie
     *
     * @param int $id_category
     * @return void
     */
    public function deleteCat($id_category): void
    {
        $request = 'DELETE FROM category WHERE id = :id';
        $delete = $this->dbConnect()->prepare($request);
        $delete->bindValue(':id', $id_category, \PDO::PARAM_INT);
        $delete->execute();
    }
}
