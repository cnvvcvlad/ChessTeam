<?php

namespace Democvidev\ChessTeam\Controller;

use Democvidev\ChessTeam\Classes\Users;
use Democvidev\ChessTeam\Model\MemberManager;
use Democvidev\ChessTeam\Service\RoleHandler;
use Democvidev\ChessTeam\Exception\NotFoundException;
use Democvidev\ChessTeam\Controller\AbstractController;

class UserController extends AbstractController
{
    /**
     * @const int MAX_SIZE_IMAGE, 2 Mo
     */
    const MAX_SIZE_IMAGE = 2097152;

    const MAX_LENGTH_IMAGE = 25;

    /**
     * @var array $extensions_valides
     */
    private $extensions_valides = ['jpg', 'jpeg', 'png', 'gif'];

    /**
     * Instance of MemberManager
     *
     * @var MemberManager
     */
    protected $memberManager;

    public function __construct()
    {
        parent::__construct();
        $this->memberManager = new MemberManager($this->getDatabase());
    }

    public function login()
    {
        return $this->view('auth.login');
    }

    public function loginUser()
    {
        $user = $this->memberManager->getByLogin($_POST['login']);
        if(!$user) {
            throw new NotFoundException('L\'utilisateur n\'existe pas !');
        }

        if (password_verify($_POST['password'], $user->password)) {
            $_SESSION['id_user'] = (int) $user->id_user;
            $_SESSION['statut'] = (int) $user->statut;
            $_SESSION['user_image'] = (string) $user->user_image;
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
        if (
            isset($_POST['inscription']) and
            isset($_FILES['image_membre']) and
            $_FILES['image_membre']['error'] == 0
        ) {
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
                    $path = dirname(__FILE__, 3) . '/public/img/uploads/' . $user_image;

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
        $this->isConnected();
        $user = $this->memberManager->showOneUser($_SESSION['id_user']);
        $this->view('user.profile', [
            'user' => $user,
        ]);
    }

    public function update($id)
    {
        $this->isConnected();
        $user = $this->memberManager->showOneUser($id);
        $this->view('user.update', [
            'user' => $user,
        ]);
    }

    public function updateUser($id)
    {
        $this->isConnected();

        if (!empty($_POST) || !empty($_FILES)) {
            extract($_POST);
            $password = password_hash($password, PASSWORD_DEFAULT);
            if ($_FILES['image_membre']['name'] == '') {
                $user_image = $_POST['old_image'];
            } elseif (
                isset($_FILES['image_membre']) and
                $_FILES['image_membre']['error'] == 0 and
                !empty($_FILES['image_membre']['name'])
            ) {
                $user_image = $_FILES['image_membre']['name'];
                if (strlen($user_image) > self::MAX_LENGTH_IMAGE) {
                    throw new NotFoundException('Le nom de l\'image est trop long');
                }
                $old_image = $_POST['old_image'];

                var_dump($password);
                exit;

                if ($_FILES['image_membre']['size'] <= self::MAX_SIZE_IMAGE) {

                    $info = pathinfo($_FILES['image_membre']['name']);

                    $extension_uploadee = $info['extension'];
                    $filename = $info['filename'];
                    $upload_dir = dirname(__FILE__, 4) . '/public/img/uploads/';

                    if (in_array($extension_uploadee, $this->$extensions_valides)) {
                        // 1st Delete old image
                        if (file_exists("$upload_dir/$old_image") and $old_image != '') {
                            $isDeleted = unlink("$upload_dir/$old_image");
                            if (!$isDeleted) {
                                throw new NotFoundException('Une erreur est survenue lors de la suppression de l\'image ancienne ! Veuillez réessayer.');
                            }
                        }
                        $new_image = $filename . md5(uniqid()) . '.' . $extension_uploadee;
                        move_uploaded_file($_FILES['image_membre']['tmp_name'], $upload_dir . $new_image);
                        $user_image = $new_image;
                    } else {
                        throw new NotFoundException(
                            "Veuillez rééssayer avec un autre format d'image !"
                        );
                    }
                } else {
                    throw new NotFoundException('Votre fichier ne doit pas dépasser 2 Mo !');
                }
            } else {
                throw new NotFoundException('Erreur de l\'upload de l\'image!');
            }
            $result = $this->memberManager->updateMembre(
                $id,
                new Users([
                    'login' => $login,
                    'email' => $email,
                    'password' => $password,
                    'user_image' => $user_image,
                ])
            );
            if ($result) {
                header('Location:' . dirname(SCRIPTS) . '/profile');
                exit();
            }
        } else {
            throw new NotFoundException('Aucune donnée reçue');
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
        if ($_SESSION['statut'] == 1) {
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
        if ($this->isConnected() && $_SESSION['statut'] === 1) {
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
