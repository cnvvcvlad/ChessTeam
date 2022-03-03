<?php

namespace Democvidev\ChessTeam\Model;

use Democvidev\ChessTeam\Classes\Category;
use Democvidev\ChessTeam\Exception\NotFoundException;
use Democvidev\ChessTeam\Model\AbstractModel;

class CategoriesManager extends AbstractModel
{
    protected $table = 'category';
    /**
     * Insère une catégorie dans la base de données
     * 
     * @param Category $category
     * @return bool
     */
    public function insertCategory(Category $category): bool
    {
        $request = 'INSERT INTO ' . $this->table . '(
            title, description, category_image, cat_author) 
            VALUES(:cat_title, :cat_description, :cat_image, :cat_author)';
        $insert = $this->db->getPDO()->prepare($request);
        $insert->bindValue(':cat_title', $category->getTitle(), \PDO::PARAM_STR);
        $insert->bindValue(':cat_description', $category->getDescription(), \PDO::PARAM_STR);
        $insert->bindValue(':cat_image', $category->getCategory_image(), \PDO::PARAM_STR);
        $insert->bindValue(':cat_author', $category->getCat_author(), \PDO::PARAM_STR);
        $insert = $insert->execute();
        return $insert;
    }

    /**
     * Met à jour une catégorie dans la base de données
     *
     * @param int $id
     * @param Category $category
     * @return bool
     */
    public function updateCategory($id, Category $category): bool
    {
        $request = 'UPDATE ' . $this->table . ' 
        SET title = :title, description = :description, category_image = :category_image, 
        cat_author = :cat_author WHERE id = :id ';
        $update = $this->db->getPDO()->prepare($request);
        $update->bindValue(':id', $id, \PDO::PARAM_INT);
        $update->bindValue(':title', $category->getTitle(), \PDO::PARAM_STR);
        $update->bindValue(':description', $category->getDescription(), \PDO::PARAM_STR);
        $update->bindValue(':category_image', $category->getCategory_image(), \PDO::PARAM_STR);
        $update->bindValue(':cat_author', $category->getCat_author(), \PDO::PARAM_STR);
        $update = $update->execute();
        return $update;
    }

    /**
     * Affichage de la liste des catégories
     *
     * @return array
     */
    public function showAllCategory(): array
    {
        $stmt = $this->requestAll();
        $categories = $this->returnCategories($stmt);
        return $categories;
    }

    /**
     * Encapsule les données d'une catégorie dans un objet Category
     * et les stocke dans un tableau
     *
     * @param \PDOStatement $stmt
     * @return array
     */
    public function returnCategories(\PDOStatement $stmt): array
    {
        $cat = [];
        while ($data = $stmt->fetch()) {
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
        $request = 'SELECT *, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') 
        AS date_creation FROM ' . $this->table . ' WHERE id = :id';
        $select = $this->db->getPDO()->prepare($request);        
        $select->bindValue(':id', $id_category, \PDO::PARAM_INT);
        $select->execute();        
        if($select->rowCount() > 0) {
            $cat[] = new Category($select->fetch());        
        return $cat;
        } else {
            throw new NotFoundException('Cette catégorie n\'existe pas');
        }
        
    }

    /**
     * Retourne le titre d'une catégorie
     *
     * @param int $id_category
     * @return array
     */
    public function nameCategory($id_category): array
    {
        $request = 'SELECT title FROM ' . $this->table . ' WHERE id = :id';
        $select = $this->db->getPDO()->prepare($request);
        $select->bindValue(':id', $id_category, \PDO::PARAM_INT);
        $select->execute();
        $cat = $select->fetch();
        return $cat;
    }

    /**
     * Supprime une catégorie
     *
     * @param int $id_category
     * @return bool
     */
    public function deleteCat($id_category): bool
    {
        $request = 'DELETE FROM ' . $this->table . ' WHERE id = :id';
        $delete = $this->db->getPDO()->prepare($request);
        $delete->bindValue(':id', $id_category, \PDO::PARAM_INT);
        $isDeketed = $delete->execute();
        return $isDeketed;
    }
}
