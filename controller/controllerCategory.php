<?php

function getAllCategory() {
    $cat_manager = new CategoryManager();
    $category = $cat_manager->ShowAllCategory();
    return $category;
}

function getCategory($id_category) {
    $cat_manager = new CategoryManager();
    $category = $cat_manager->ShowCategory($id_category);
    if($category != 0) {
        return $category;
    } else {
        throw new Exception ('Désole !');
    }

}

function showNameCategory($id_category) {
    if(!empty($id_category)) {
        $cat_manager = new CategoryManager();
        $category = $cat_manager->nameCategory($id_category);
        $category = implode($category);
        return $category;
    } else {
        echo 'Generique';
    }
}

//function showNameAuthor($user_id)
//{
//    if(!empty($user_id)) {
//        $member_manager = new UsersManager();
//        $member = $member_manager->nameUser($user_id);
//        $login_user = implode($member);
//        return $login_user;
//    } else {
//        echo 'Admin';
//    }
//    return;
//}

function deleteCategory ($id_category)
{
    $cat_manager = new CategoryManager();
    $category = $cat_manager->deleteC($id_category);
}