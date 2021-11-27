<?php

class CategoryController
{
    /**
     * Récupère la liste des catégories
     *
     * @return array
     */
    function getAllCategory(): array
    {
        $cat_manager = new CategoriesManager();
        $category = $cat_manager->showAllCategory();
        return $category;
    }

    /**
     * Récupérer une catégorie par son id
     *
     * @param int $id_category
     * @return array
     */
    function getCategory($id_category): array
    {
        $cat_manager = new CategoriesManager();
        $category = $cat_manager->showCategory($id_category);
        return $category;
    }

    /**
     * Récupérér le nom d'une catégorie par son id
     *
     * @param int $id_category
     * @return string
     */
    function showNameCategory($id_category): string
    {
        $category_name = 'Generique';
        if (!empty($id_category)) {
            $cat_manager = new CategoriesManager();
            $category = $cat_manager->nameCategory($id_category);
            $category_name = implode($category);
            return $category_name;
        } 
        return $category_name;
    }

    /**
     * Supprimer une catégorie
     *
     * @param int $id_category
     * @return void
     */
    function deleteCategory($id_category): void
    {
        $cat_manager = new CategoriesManager();
        $cat_manager->deleteCat($id_category);
        header('location:index.php?action=allCategory');
        exit();
    }
}
