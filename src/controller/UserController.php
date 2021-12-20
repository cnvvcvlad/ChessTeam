<?php

namespace Democvidev\ChessTeam\Controller;

use Democvidev\ChessTeam\Classes\Users;
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

    public function register()
    {
        return $this->view('auth.register');
    }

    public function registerUser()
    {
        if(isset($_POST['inscription']) and
        isset($_FILES['image_membre']) and
        $_FILES['image_membre']['error'] == 0) {
            extract($_POST);
            // TODO validation des données nord coders

            $password = password_hash($password, PASSWORD_DEFAULT);

            if ($_FILES['image_membre']['size'] <= 2000000) {
                $extension_autorisee = ['jpg', 'jpeg', 'png', 'gif'];
    
                $info = pathinfo($_FILES['image_membre']['name']);
    
                $extension_uploadee = $info['extension'];
    
                if (in_array($extension_uploadee, $extension_autorisee)) {
                    $user_image = $_FILES['image_membre']['name'];
    
                    //                $user_image = uniqid() . $user_image;
                    $path = dirname(__FILE__, 3) .'/public/img/uploads/' . $user_image;
    
                    move_uploaded_file($_FILES['image_membre']['tmp_name'], $path);
    
                    $this->memberManager->insertMembre(
                        new Users([
                            'login' => $login,
                            'email' => $email,
                            'password' => $password,
                            'user_image' => $user_image,
                        ])
                    );                        
                    header('Location:' . dirname(SCRIPTS) . '/login');
                    exit();
                } else {
                    throw new NotFoundException(
                        "Veuillez rééssayer avec un autre format d'image !"
                    );
                }
            } else {
                throw new NotFoundException('Votre fichier ne doit pas dépasser 2 Mo !');
            }
        }
    }

    public function profile()
    {
        $user = $this->memberManager->showOneUser($_SESSION['id_user']);        
        $this->view('user.profile', [
            'user' => $user,
        ]);
    }

    public function update($id)
    {
        $user = $this->memberManager->showOneUser($id);
        $this->view('user.update', [
            'user' => $user,
        ]);
    }

    public function updateUser($id)
    {
        
        if(isset($_POST['update']) and
        isset($_FILES['image_membre']) and
        $_FILES['image_membre']['error'] == 0) {
            extract($_POST);
            // TODO validation des données nord coders

            $password = password_hash($password, PASSWORD_DEFAULT);
            

            if ($_FILES['image_membre']['size'] <= 2000000) {
                $extension_autorisee = ['jpg', 'jpeg', 'png', 'gif'];
    
                $info = pathinfo($_FILES['image_membre']['name']);
    
                $extension_uploadee = $info['extension'];
    
                if (in_array($extension_uploadee, $extension_autorisee)) {
                    $user_image = $_FILES['image_membre']['name'];
    
                    //                $user_image = uniqid() . $user_image;
                    $path = dirname(__FILE__, 3) .'/public/img/uploads/' . $user_image;
    
                    move_uploaded_file($_FILES['image_membre']['tmp_name'], $path);
    
                    $this->memberManager->updateMembre(
                        $id,
                        new Users([
                            'login' => $login,
                            'email' => $email,
                            'password' => $password,
                            'user_image' => $user_image,
                        ])
                    );                        
                    header('Location:' . dirname(SCRIPTS) . '/profile');
                    exit();
                } else {
                    throw new NotFoundException(
                        "Veuillez rééssayer avec un autre format d'image !"
                    );
                }
            } else {
                throw new NotFoundException('Votre fichier ne doit pas dépasser 2 Mo !');
            }
        }
    }

    public function logout()
    {
        session_destroy();
        return header('Location:' . dirname(SCRIPTS) . '/');
    }

    public function destroy($id)
    {        
        $this->isConnected();
        $this->memberManager->deleteU($id);
        if($_SESSION['statut'] == 1) {
            header('Location:' . dirname(SCRIPTS) . '/admin/members');
        } else {
            session_destroy();
            header('Location:' . dirname(SCRIPTS) . '/');
        }
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
