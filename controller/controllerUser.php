<?php


require 'model/MemberManager.php';
require 'classes/Users.php';

$manager_user = new MemberManager();


function getInfoUser($user_id)
{
    $member_manager = new UsersManager();
    $member = $member_manager->ShowOneUser($user_id);
    return $member;
}



function getAllMembers()
{
    $member_manager = new UsersManager();
    $members = $member_manager->ShowAllUsers();
    return $members;
}

function showNameAuthor($user_id)
{
    $member_manager = new UsersManager();
    $member = $member_manager->nameUser($user_id);
    $login_user = implode($member);
    return $login_user;
}

function deleteUser($user_id)
{
    $member_manager = new UsersManager();
    $member_manager->deleteU($user_id);

    if (isAdmin()) {
        header('location:index.php?action=allMembers');
    } else {
        session_destroy();
        header('location:./');
    }
}
