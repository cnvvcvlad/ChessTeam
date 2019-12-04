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
    $cat_manager = new CategoryManager();
    $category = $cat_manager->nameCategory($id_category);
    $category = implode($category);
    return $category;
}
