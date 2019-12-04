<?php

require_once 'DataBase.php';

class MemberManager extends DataBase
{
    public function getDataBase()
    {
        return $this->dataBase;
    }

    public function setDataBase($dataBase)
    {
        $this->dataBase = $dataBase;
    }


    public function insertMembre(Users $member)
    {
        if ($this->existLogin($member->getLogin())) {
            throw new Exception("Désolé cet utilisateur existe déjà");
        }

        $request = 'INSERT INTO users(login, email, password, user_image) VALUES(:login, :email, :password, :user_image)';
        $insert = $this->dbConnect()->prepare($request);
        $insert = $insert->execute([
        "login" => $member->getLogin(),
        "email" => $member->getEmail(),
        "password" => $member->getPassword(),
        "user_image" => $member->getUser_image()
    ]);
    }

    public function existLogin($login)
    {
        $request = 'SELECT * FROM users WHERE login = :login';
        $insert = $this->dbConnect()->prepare($request);
        $insert->execute(["login" => $login]);

        if ($insert->rowCount() != 0) {
            return true;
        }
        return false;
    }

    public function existId($id_user)
    {
        $request = 'SELECT * FROM users WHERE id_user = :id_user';
        $insert = $this->dbConnect()->prepare($request);
        $insert->execute(["id_user" => $id_user]);

        if ($insert->rowCount() != 0) {
            return true;
        }
        return false;
    }

    public function log($login, $password)
    {
        $request = 'SELECT * FROM users WHERE login = :login AND password = :password';
        $request = $this->dbConnect()->prepare($request);
        $request->execute(["login" => $login, "password" => $password]);
    
        if ($request->rowCount() != 0) {
            $resultat = $request->fetch();
        
            $user = new Users($resultat);
            $_SESSION['id_user'] = $user->getId_user();
            $_SESSION['email'] = $user->getEmail();
            $_SESSION['login'] = $user->getLogin();
            $_SESSION['password'] = $user->getPassword();
            $_SESSION['user_image'] = $user->getUser_image();
            $_SESSION['statut'] = $user->getStatut();
            // $request->closeCursor();
        } else {
            throw new Exception("Login et/ou mot de passe incorrect! Veuillez r�essayer !");
        }
    }

    public function updateMembre($id_user, Users $member) {
        if ($this->existId($member->getId_user())) {
            throw new Exception("Désolé cet utilisateur n'existe pas");
        }

        $request = 'UPDATE users SET login = :login, email = :email, password = :password, user_image = :user_image  WHERE id_user = :id_user';
        $update = $this->dbConnect()->prepare($request);
        $update = $update->execute([
            "id_user" => $id_user,
            "login" => $member->getLogin(),
            "email" => $member->getEmail(),
            "password" => $member->getPassword(),
            "user_image" => $member->getUser_image()
        ]);
        $_SESSION['user_image'] = $member->getUser_image();
        return $update;
    }

    
}
