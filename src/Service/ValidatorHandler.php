<?php

namespace Democvidev\ChessTeam\Service;

class ValidatorHandler
{

    /**
     * Validation générales des données avec un minimum de caractères à 2
     *
     * @param string $data
     * @return string
     */
    public function valid($data): string
    {
        $data = trim($data); //supprimer les espaces dans la requête de l'internaute
        $data = stripslashes($data); // Supprime les antislashs d'une chaîne
        $data = htmlspecialchars($data); //sécuriser le formulaire contre les failles html
        $data = strip_tags($data); // supprimer les balises html et php dans la requête

        if (strlen($data) < 2) {
            throw new \Exception('Caractères insuffisants !!');
        }
        return $data;
    }

    /**
     * Validation des données pour les identifiants et les mots de passe
     *
     * @param string $data
     * @return string
     */
    public function validate($data): string
    {
        if (strlen($this->valid($data)) < 6) {
            throw new \Exception('Caractères insuffisants !');
        } elseif (strlen($data) > 10) {
            throw new \Exception(
                'Votre identifiant ou mot de pase ne doit pas déppasser 10 caractères !'
            );
        }
        return $data;
    }

    /**
     * Validation de l'email
     * 
     * @param string $data
     * @return string
     */
    public function validateEmail($data): string
    {
        $valid = filter_var($this->valid($data), FILTER_VALIDATE_EMAIL);
        if (empty($valid)) {
            throw new \Exception('Veuillez insérer une adresse mail valide !');
        } else {
            if (strlen($this->valid($data)) < 4) {
                throw new \Exception('Caractères insuffisants !');
            } elseif (strlen($this->valid($data)) > 30) {
                throw new \Exception(
                    'Veuillez ne pas déppasser 30 caractères !'
                );
            }
        }
        return $data;
    }

    /**
     * Validation du nom de la photo avec un minimum de caractères à 4 et un maximum de 20
     *
     * @param string $data
     * @return string
     */
    public function validatePhoto($data): string
    {
        if (strlen($this->valid($data)) < 4) {
            throw new \Exception('Caractères insuffisants !');
        }
        if (strlen($this->valid($data)) > 20) {
            throw new \Exception(
                'Le nom de la photo ne doit pas déppasser 20 caractères !'
            );
        }
        return $data;
    }
}
