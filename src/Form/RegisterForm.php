<?php

namespace Democvidev\ChessTeam\Form;

use Democvidev\ChessTeam\Classes\Users;
use Democvidev\ChessTeam\Database\DataBaseConnection;
use Democvidev\ChessTeam\Model\AbstractModel;
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
        $this->manager_user = new MemberManager(new DataBaseConnection());
        $this->role = new RoleHandler();
    }

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
            } elseif (isset($_POST['update'])) {
                extract($_POST);
                $id_user = htmlspecialchars($id_user);
                $login = $this->validator->validate($login);
                $email = $this->validator->validateEmail($email);
                $password = $this->validator->validate($password);
                $password = password_hash($password, PASSWORD_DEFAULT);
                if (
                    isset($_FILES['user_image']) and
                    $_FILES['user_image']['error'] == 0
                ) {
                    $user_image = $this->validator->validatePhoto(
                        $_FILES['user_image']['name']
                    );
                    if ($_FILES['user_image']['size'] <= 2000000) {
                        $extension_autorisee = ['jpg', 'jpeg', 'png', 'gif'];
                        $info = pathinfo($_FILES['user_image']['name']);
                        $extension_uploadee = $info['extension'];
                        if (
                            in_array($extension_uploadee, $extension_autorisee)
                        ) {
                            $user_image = $_FILES['user_image']['name'];
                            move_uploaded_file(
                                $_FILES['user_image']['tmp_name'],
                                'assets/img/uploads/' . $user_image
                            );
                        } else {
                            throw new \Exception(
                                'Veuillez rééssayer avec un autre format !'
                            );
                        }
                    } else {
                        throw new \Exception(
                            'Votre fichier ne doit pas dépasser 2 Mo !'
                        );
                    }
                }
                $this->manager_user->updateMembre(
                    $id_user,
                    new Users([
                        'login' => $login,
                        'email' => $email,
                        'password' => $password,
                        'user_image' => $user_image,
                    ])
                );
                if ($this->role->isAdmin()) {
                    header(
                        'location:index.php?action=allMembers&memberId=' .
                            $id_user
                    );
                    exit();
                } else {
                    header('location:index.php?action=home');
                }
                exit();
            }
        }
    }
}
