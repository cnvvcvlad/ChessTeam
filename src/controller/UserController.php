<?php

namespace Democvidev\ChessTeam\Controller;

use Democvidev\ChessTeam\Model\MemberManager;
use Democvidev\ChessTeam\Service\RoleHandler;

class UserController
{
    // private $model;
    // private $view;

    /**
     * Recupérer les données de l'utilisateur
     *
     * @param int $user_id
     * @return array
     */
    public function getInfoUser($user_id): array
    {
        $member_manager = new MemberManager();
        $member = $member_manager->showOneUser($user_id);
        return $member;
    }

    /**
     * Recupérer les données de tous les utilisateurs inscrits
     *
     * @return array
     */
    public function getAllMembers(): array
    {
        $member_manager = new MemberManager();
        $members = $member_manager->showAllUsers();
        return $members;
    }

    /**
     * Afficher le login de l'auteur
     *
     * @param int $user_id
     * @return string
     */
    public function showNameAuthor($user_id): string
    {
        if (!empty($user_id)) {
            $member_manager = new MemberManager();
            $member = $member_manager->nameUser($user_id);
            $login_user = implode($member);
            return $login_user;
        } else {
            $login_user = 'Admin';
        }
        return $login_user;
    }

    /**
     * Supprimer un utilisateur
     *
     * @param int $user_id
     * @return void
     */
    public function deleteUser($user_id)
    {
        $member_manager = new MemberManager();
        $member_manager->deleteU($user_id);
        $role = new RoleHandler();
        if ($role->isAdmin()) {
            header('location:index.php?action=allMembers');
            exit;
        } else {
            session_destroy();
            header('location:./');
            exit;
        }
    }

    public function helloUser()
    {
        $role = new RoleHandler();
        if ($role->isConnected()) {
            echo 'Salut ' .
                strtoupper(
                    $this->showNameAuthor(
                        htmlspecialchars($_SESSION['id_user'])
                    )
                );
        }
    }
}
