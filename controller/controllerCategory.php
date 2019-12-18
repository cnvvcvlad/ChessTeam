<?php

function getAllCategory() {
    $cat_manager = new CategoriesManager();
    $category = $cat_manager->showAllCategory();
    return $category;
}

function getCategory($id_category) {
    $cat_manager = new CategoriesManager();
    $category = $cat_manager->showCategory($id_category);
        return $category;

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
    $category = $cat_manager->deleteCat($id_category);
}