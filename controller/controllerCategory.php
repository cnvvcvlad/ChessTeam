<?php

function getAllCategory() {
    $cat_manager = new CategoryManager();
    $category = $cat_manager->ShowAllCategory();
    return $category;
}

function getCategory($id_category) {
    $cat_manager = new CategoryManager();
    $category = $cat_manager->ShowCategory($id_category);
    return $category;
}

function showNameCategory($id_category) {
    if(!isset($id_category)) {
        $cat_manager = new CategoryManager();
        $category = $cat_manager->nameCategory($id_category);
        $category = implode($category);
        return $category;
    } else {
        echo 'Generique';
    }
    return;
}

function deleteCategory ($id_category)
{
    $cat_manager = new CategoryManager();
    $category = $cat_manager->deleteC($id_category);
}