<?php

namespace Democvidev\ChessTeam\Form;

use Democvidev\ChessTeam\Model\MemberManager;
use Democvidev\ChessTeam\Service\ValidatorHandler;

class AuthenticationForm
{
    private $validator;
    private $manager_user;

    public function __construct()
    {
        $this->validator = new ValidatorHandler();
        $this->manager_user = new MemberManager();
    }

    public function authenticationForm()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['connexion'])) {
                sleep(1);
                $login = $this->validator->validate($_POST['login']);
                $password = $this->manager_user->checkPassword($login);
                $passwordHash = $password['password'];
                $passwordUser = $this->validator->validate($_POST['password']);
                if (password_verify($passwordUser, $passwordHash)) {
                    $this->manager_user->log($login, $passwordHash);
                    header('location:index.php?action=connected');
                    exit();
                }
                throw new \Exception('Le mot de passe est invalide !');
            }
        }
    }
}
