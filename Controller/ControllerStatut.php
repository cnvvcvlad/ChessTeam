<?php
namespace Democvidev\App;

use Democvidev\App\ControllerUser;

class ControllerStatut {

    
    public function validate($data)
    {
        $data = trim($data); //supprimer les espaces dans la requête de l'internaute
        $data = stripslashes($data);// Supprime les antislashs d'une chaîne
        $data = htmlspecialchars($data); //sécuriser le formulaire contre les failles html
        $data = strip_tags($data); // supprimer les balises html et php dans la requête
        
        if (strlen($data) < 2) {
            throw new \Exception("Caractères insuffisants !!");
    }
    return $data;
}


    public function validator($data)
    {
        
        if (strlen(ControllerStatut::validate($data)) < 6) {
            throw new \Exception("Caractères insuffisants !");
        } elseif (strlen($data) > 10) {
            throw new \Exception ('Votre identifiant ou mot de pase ne doit pas déppasser 10 caractères !');
        }
        return $data;
    }

    public function emailValidator($data)
    {
        $valid = filter_var(ControllerStatut::validate($data), FILTER_VALIDATE_EMAIL);
        if (empty($valid)) {
            throw new \Exception ('Veuillez insérer une adresse mail valide !');
        } else {
            
            if (strlen(ControllerStatut::validate($data)) < 4) {
                throw new \Exception("Caractères insuffisants !");
            } elseif (strlen(ControllerStatut::validate($data)) > 30) {
                throw new \Exception ('Veuillez ne pas déppasser 30 caractères !');
            }
        }
        return $data;
    }

    public function photoValidator($data)
    {
        if (strlen(ControllerStatut::validate($data)) < 4) {
            throw new \Exception("Caractères insuffisants !");
        } if (strlen(ControllerStatut::validate($data)) > 20) {
            throw new \Exception ('Le nom de la photo ne doit pas déppasser 20 caractères !');
        }
        return $data;
    }


    public function isConnected()
    {
        if (isset($_SESSION['id_user'])) {
            return true;
        }
        return false;
    }


    public function isAdmin()
    {
        if (ControllerStatut::isConnected() && $_SESSION['statut'] == 1) {
            return true;
        }
        return false;
    }

    public function helloUser()
    {
        if (ControllerStatut::isConnected()) {
            
            echo 'Salut ' . strtoupper(ControllerUser::showNameAuthor(htmlspecialchars($_SESSION['id_user'])));
        }
    }

    public function backPageId()
    {
        if (isset($_SERVER['HTTP_REFERER'])) {
            return true;
        } else {
            return false;
        }
    }

}