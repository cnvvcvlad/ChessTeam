<?php

namespace Democvidev\ChessTeam\Form;

use Democvidev\ChessTeam\Classes\Users;
use Democvidev\ChessTeam\Model\MemberManager;
use Democvidev\ChessTeam\Service\RoleHandler;
use Democvidev\ChessTeam\Service\ValidatorHandler;

class RegisterForm
{

    private $validator;
    private $manager_user;
    private $role;

    public function __construct()
    {
        $this->validator = new ValidatorHandler();
        $this->manager_user = new MemberManager();
        $this->role = new RoleHandler();
    }

    // public function registerForm() {
    //     if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //         if (empty($_POST['pseudo']) || empty($_POST['password']) || empty($_POST['password_confirm'])) {
    //             header('location:index.php?action=register&alert=errorRegister');
    //             exit();
    //         } else {
    //             if ($_POST['password'] == $_POST['password_confirm']) {
    //                 $pseudo = htmlspecialchars($_POST['pseudo']);
    //                 $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    //                 $password_confirm = password_hash($_POST['password_confirm'], PASSWORD_DEFAULT);
    //                 $email = htmlspecialchars($_POST['email']);
    //                 $date_creation = date('Y-m-d H:i:s');
    //                 $date_last_connection = date('Y-m-d H:i:s');
    //                 $role = 'user';
    //                 $this->register($pseudo, $password, $password_confirm, $email, $date_creation, $date_last_connection, $role);
    //             } else {
    //                 header('location:index.php?action=register&alert=errorRegister');
    //                 exit();
    //             }
    //         }
    //     }
    // }

    public function registerForm()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (
                isset($_POST['inscription']) and
                isset($_FILES['image_membre']) and
                $_FILES['image_membre']['error'] == 0
            ) {
                extract($_POST);
                $login = $this->validator->validate($login);
                $email = $this->validator->validateEmail($email);
                $password = $this->validator->validate($password);
                $password = password_hash($password, PASSWORD_DEFAULT);
                $user_image = $this->validator->validatePhoto(
                    $_FILES['image_membre']['name']
                );
                if ($_FILES['image_membre']['size'] <= 2000000) {
                    $extension_autorisee = ['jpg', 'jpeg', 'png', 'gif'];
                    $info = pathinfo($_FILES['image_membre']['name']);
                    $extension_uploadee = $info['extension'];
                    if (in_array($extension_uploadee, $extension_autorisee)) {
                        $user_image = $_FILES['image_membre']['name'];
                        //                $user_image = uniqid() . $user_image;
                        $path = 'assets/img/uploads/' . $user_image;
                        move_uploaded_file(
                            $_FILES['image_membre']['tmp_name'],
                            $path
                        );
                        $this->manager_user->insertMembre(
                            new Users([
                                'login' => $login,
                                'email' => $email,
                                'password' => $password,
                                'user_image' => $user_image,
                            ])
                        );
                        if ($this->role->isAdmin()) {
                            header(
                                'location:index.php?action=allMembers&alert=aded'
                            );
                            exit();
                        }
                        header(
                            'location:index.php?action=connexion&alert=inscrit'
                        );
                        exit();
                    } else {
                        throw new \Exception(
                            "Veuillez rééssayer avec un autre format d'image !"
                        );
                    }
                } else {
                    throw new \Exception(
                        'Votre fichier ne doit pas dépasser 2 Mo !'
                    );
                }
            }
        }
    }
}
