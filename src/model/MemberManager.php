<?php

namespace Democvidev\ChessTeam\Model;

use Democvidev\ChessTeam\Classes\Users;
use Democvidev\ChessTeam\Model\AbstractModel;
use Democvidev\ChessTeam\Service\RoleHandler;

class MemberManager extends AbstractModel
{    
    protected $table = 'user';

    /**
     * Verifier le mot de passe lors de la connexion
     *
     * @param string $login
     * @return array
     */
    public function checkPassword($login): array 
    {
        $request = 'SELECT password FROM ' . $this->table . ' WHERE login = :login';
        $select = $this->db->getPDO()->prepare($request);
        $select->execute([
            "login" => $login
        ]);
        if ($select->rowCount() != 0) {
            $password = $select->fetch();
            return $password;
        }
        throw new \Exception("Le mot de passe est invalide !");
    }

    /**
     * Insère un nouveau membre dans la base de données
     *
     * @param Users $member
     * @return void
     */
    public function insertMembre(Users $member): void
    {
        if ($this->existLogin($member->getLogin())) {
            throw new \Exception("Désolé cet utilisateur existe déjà");
        }
        $request = 'INSERT INTO ' . $this->table . '(login, email, password, user_image) VALUES(:login, :email, :password, :user_image)';
        $insert = $this->db->getPDO()->prepare($request);
        $insert = $insert->execute([
            "login" => $member->getLogin(),
            "email" => $member->getEmail(),
            "password" => $member->getPassword(),
            "user_image" => $member->getUser_image()
        ]);
    }

    /**
     * Vérifie si le login existe déjà
     *
     * @param string $login
     * @return boolean
     */
    public function existLogin($login): bool
    {
        $request = 'SELECT * FROM ' . $this->table . ' WHERE login = :login';
        $insert = $this->db->getPDO()->prepare($request);
        $insert->execute(["login" => $login]);
        if ($insert->rowCount() != 0) {
            return true;
        }
        return false;
    }

    /**
     * Vérifie si l'utilisateur existe déjà
     *
     * @param int $id_user
     * @return boolean
     */
    public function existId($id_user): bool
    {
        $request = 'SELECT * FROM ' . $this->table . ' WHERE id_user = :id_user';
        $insert = $this->db->getPDO()->prepare($request);
        $insert->execute(["id_user" => $id_user]);
        if ($insert->rowCount() != 0) {
            return true;
        }
        return false;
    }

    /**
     * Vérifie les informations de connexion et créer une nouvelle session du membre
     *
     * @param string $login
     * @param string $password
     * @return void
     */
    public function log($login, $password): void
    {
        $request = 'SELECT * FROM ' . $this->table . ' WHERE login = :login AND password = :password';
        $request = $this->db->getPDO()->prepare($request);
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
            throw new \Exception("Login et/ou mot de passe incorrect! Veuillez réessayer !");
        }
    }

    /**
     * Mis à jour des informations du membre
     *
     * @param int $id_user
     * @param Users $member
     * @return void
     */
    public function updateMembre($id_user, Users $member): void
    {
        if ($this->existId($member->getId_user())) {
            throw new \Exception("Désolé cet utilisateur n'existe pas");
        }
        $request = 'UPDATE ' . $this->table . ' SET login = :login, email = :email, password = :password, user_image = :user_image  WHERE id_user = :id_user';
        $update = $this->db->getPDO()->prepare($request);
        $update = $update->execute([
            "id_user" => $id_user,
            "login" => $member->getLogin(),
            "email" => $member->getEmail(),
            "password" => $member->getPassword(),
            "user_image" => $member->getUser_image()
        ]);
        $role = new RoleHandler();
        if (!$role->isAdmin() and $_SESSION['id_user'] == $id_user) {
            $_SESSION['user_image'] = $member->getUser_image();
        }         
    }

    /**
     * Récupère les informations du membre
     *
     * @param int $user_id
     * @return array
     */
    public function showOneUser($user_id): array
    {
        $request = 'SELECT * FROM ' . $this->table . ' WHERE id_user = :id_user';
        $select = $this->db->getPDO()->prepare($request);
        $select->execute(["id_user" => $user_id]);
        $member[] = new Users($select->fetch());
        return $member;
    }

    /**
     * Récupère la liste des membres en descendant
     *
     * @return array
     */
    public function showAllUsers(): array
    {
        $request = 'SELECT * FROM ' . $this->table . ' WHERE statut = 0  ORDER BY id_user DESC';
        $select = $this->db->getPDO()->query($request);
        $members = [];
        while ($data = $select->fetch()) {
            $members[] = new Users($data);
        }
        return $members;
    }

    /**
     * Récupère le nom du membre en fonction de son id
     *
     * @param int $user_id
     * @return array
     */
    public function nameUser($user_id): array
    {
        $request = 'SELECT login FROM ' . $this->table . ' WHERE id_user = :id_user';
        $select = $this->db->getPDO()->prepare($request);
        $select->execute(["id_user" => $user_id]);
        $member = $select->fetch();
        return $member;
    }

    /**
     * Supprime le membre
     *
     * @param int $user_id
     * @return void
     */
    public function deleteU($user_id): void
    {
        $request = 'DELETE FROM ' . $this->table . ' WHERE id_user = :id_user';
        $delete = $this->db->getPDO()->prepare($request);
        $delete->execute(["id_user" => $user_id]);
    }
}
