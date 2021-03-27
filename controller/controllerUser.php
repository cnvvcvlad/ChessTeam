<?php
namespace Democvidev\Controller;



function getInfoUser($user_id)
{
    $member_manager = new MemberManager();
    $member = $member_manager->showOneUser($user_id);
    return $member;
}



function getAllMembers()
{
    $member_manager = new MemberManager();
    $members = $member_manager->showAllUsers();
    return $members;
}

function showNameAuthor($user_id)
{
    if(!empty($user_id)) {
        $member_manager = new MemberManager();
        $member = $member_manager->nameUser($user_id);
        $login_user = implode($member);
        return $login_user;
    } else {
        echo 'Admin';
    }
    return;
}

function deleteUser($user_id)
{
    $member_manager = new MemberManager();
    $member_manager->deleteU($user_id);

    if (isAdmin()) {
        header('location:index.php?action=allMembers');
    } else {
        session_destroy();
        header('location:./');
    }
}
