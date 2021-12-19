<?php

namespace Democvidev\ChessTeam\Controller;

use Democvidev\ChessTeam\Model\MemberManager;
use Democvidev\ChessTeam\Service\RoleHandler;
use Democvidev\ChessTeam\Exception\NotFoundException;
use Democvidev\ChessTeam\Controller\AbstractController;

class UserController extends AbstractController
{
    private $memberManager;

    public function __construct()
    {
        $this->memberManager = new MemberManager($this->getDatabase());
    }

    public function login()
    {
        return $this->view('auth.login');
    }

    public function loginUser()
    {
        $user = $this->memberManager->getByLogin($_POST['login']);
        
        if(password_verify($_POST['password'], $user->password)) {
            $_SESSION['id_user'] = (int) $user->id_user;
            $_SESSION['statut'] = (int) $user->statut;
            return header('Location:' . dirname(SCRIPTS) . '/');
        } else {
            throw new NotFoundException('Le mot de passe est invalide !');
        }
    }

    public function logout()
    {
        session_destroy();
        return header('Location:' . dirname(SCRIPTS) . '/');
    }

    /**
     * Recupérer les données de l'utilisateur
     *
     * @param int $user_id
     * @return array
     */
    public function getInfoUser($user_id): array
    {
        $member = $this->memberManager->showOneUser($user_id);
        return $member;
    }

    /**
     * Recupérer les données de tous les utilisateurs inscrits
     *
     * @return array
     */
    public function getAllMembers(): array
    {
        $members = $this->memberManager->showAllUsers();
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
            $member = $this->memberManager->nameUser($user_id);
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
        $this->memberManager->deleteU($user_id);
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

    /**
     * Affichage d'un message de salutation pour les membres connectés
     *
     * @return void
     */
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
