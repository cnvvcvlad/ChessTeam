<?php

function getAllCategory() {
    $cat_manager = new CategoriesManager();
    $category = $cat_manager->ShowAllCategory();
    return $category;
}

function getCategory($id_category) {
    $cat_manager = new CategoriesManager();
    $category = $cat_manager->ShowCategory($id_category);
    if($category != 0) {
        return $category;
    } else {
        throw new Exception ('Désole !');
    }

}

function showNameCategory($id_category) {
    if(!empty($id_category)) {
        $cat_manager = new CategoriesManager();
        $category = $cat_manager->nameCategory($id_category);
        $category = implode($category);
        return $category;
    } else {
        echo 'Generique';
    }
}



function deleteCategory ($id_category)
{
    $cat_manager = new CategoriesManager();
    $category = $cat_manager->deleteC($id_category);
}