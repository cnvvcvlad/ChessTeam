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


    public function checkPassword($login, MemberManager $member)
    {
        $request = 'SELECT password FROM users WHERE login = :login';
        $select = $this->dbConnect()->prepare($request);
        $select->execute([
            "login" => $login
        ]);
        if ($select->rowCount() != 0) {
            $password = $select->fetch();
            return $password;
        }
        throw new Exception("Le login est invalide !");
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
        } else {
            throw new Exception("Login et/ou mot de passe incorrect! Veuillez réessayer !");
        }
    }

    public function updateMembre($id_user, Users $member)
    {
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
        if (isAdmin() and $_SESSION['id_user'] != $id_user) {
            return $_SESSION['user_image'];
        } elseif (isConnected()) {
            $_SESSION['user_image'] = $member->getUser_image();
        }
    }


    public function showOneUser($user_id)
    {
        $request = 'SELECT * FROM users WHERE id_user = :id_user';
        $select = $this->dbConnect()->prepare($request);
        $select->execute(["id_user" => $user_id]);

        $member[] = new Users($select->fetch());

        return $member;
    }

    public function showAllUsers()
    {
        $request = 'SELECT * FROM users WHERE statut = 0  ORDER BY id_user DESC';
        $select = $this->dbConnect()->prepare($request);
        $select->execute();

        $members = [];

        while ($data = $select->fetch()) {
            $members[] = new Users($data);
        }
        return $members;
    }

    public function nameUser($user_id)
    {
        $request = 'SELECT login FROM users WHERE id_user = :id_user';
        $select = $this->dbConnect()->prepare($request);
        $select->execute(["id_user" => $user_id]);

        $member = $select->fetch();

        return $member;
    }

    public function deleteU($user_id)
    {
        $request = 'DELETE FROM users WHERE id_user = :id_user';
        $delete = $this->dbConnect()->prepare($request);
        $delete->execute(["id_user" => $user_id]);
    }
}
