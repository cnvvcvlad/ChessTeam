<?php

require_once 'Generique.php';

class Users extends Generique
{
    private $id_user;
    private $login;
    private $email;
    private $password;
    private $user_image;
    private $date_inscription;
    private $statut;


    public function __construct(array $data)
    {
        if ($data) {
            parent::__construct($data);   // heritage du constructeur de la classe Generique     
        }
    }

    /**
     * Set the value of id_user
     *
     * @return  self
     */
    public function setId_user($id_user)
    {
        $this->id_user = $id_user;

        return $this;
    }


    public function setLogin($login)
    {
        return $this->login = $login;
    }

    public function setEmail($email)
    {
        return $this->email = $email;
    }

    public function setPassword($password)
    {
        return $this->password = $password;
    }

    public function setUser_image($user_image)
    {
        return $this->user_image = $user_image;
    }

    public function setDate_inscription($date_inscription)
    {
        return $this->date_inscription = $date_inscription;
    }

    public function setStatut($statut)
    {
        return $this->statut = $statut;
    }

    public function getId_user()
    {
        return $this->id_user;
    }

    public function getLogin()
    {
        return $this->login;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getUser_image()
    {
        return $this->user_image;
    }

    public function getDate_inscription()
    {
        return $this->date_inscription;
    }

    public function getStatut()
    {
        return $this->statut;
    }


}