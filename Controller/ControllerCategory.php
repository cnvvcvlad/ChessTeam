<?php

namespace Democvidev\App;

use Democvidev\App\CategoriesManager;

class ControllerCategory {
    
    public static function getAllCategory() {
        $cat_manager = new CategoriesManager();
        $category = $cat_manager->showAllCategory();
        return $category;
    }
    
    public function getCategory($id_category) {
        $cat_manager = new CategoriesManager();
        $category = $cat_manager->showCategory($id_category);
        return $category;
        
    }
    
    
    public function showNameCategory($id_category) {
        if(!empty($id_category)) {
            $cat_manager = new CategoriesManager();
            $category = $cat_manager->nameCategory($id_category);
            $category = implode($category);
            return $category;
        } else {
            echo 'Generique';
        }
    }
    
    public function deleteCategory ($id_category)
    {
        $cat_manager = new CategoriesManager();
        $cat_manager->deleteCat($id_category);
        header('location:index.php?action=allCategory');
    }
    
}