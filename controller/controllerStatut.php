<?php

function validate($data)
{
    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);

    if (strlen($data) < 6) {
        throw new Exception("Caractères insuffisants !");
    } elseif (strlen($data) > 10) {
        throw new Exception ('Votre identifiant ou mot de pase ne doit pas déppasser 10 caractères !');
    }
    return $data;
}

function emailValidator($data) {
    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);
    $valid = filter_var($data, FILTER_VALIDATE_EMAIL);
    if(empty($valid)) {
        throw new Exception ('Veuillez insérer une adresse mail valide !');
    } else {

        if (strlen($data) < 3) {
            throw new Exception("Caractères insuffisants !");
        } elseif (strlen($data) > 30) {
            throw new Exception ('Veuillez ne pas déppasser 30 caractères !');
        }
    }
    return $data;
}

function photoValidator ($data) {
    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);
    if (strlen($data) < 3) {
        throw new Exception("Caractères insuffisants !");
    } elseif (strlen($data) > 30) {
        throw new Exception ('Le nom de la photo ne doit pas déppasser 30 caractères !');
    }
    return $data;
}


function isConnected() {
    if (isset($_SESSION['id_user'])) {
        return true;
    }
    return false;
}


function isAdmin() {
    if(isConnected() && $_SESSION['statut'] == 1) {
        return true;
    }
    return false;
}

function helloUser() {
    if(isConnected()) {

        echo 'Salut ' . strtoupper(htmlspecialchars($_SESSION['login']));
    }
}

function backPageId() {
    if (isset($_SERVER['HTTP_REFERER']) AND isset($_SESSION['id_user'])) {
        $url = basename($_SERVER['HTTP_REFERER']);
        if ($url=='index.php?action=myArticlesId&id=' . $_SESSION['id_user']) {
            return true;
        }
        return false;
    }
    return ;
}

function showImage($user_image) {
    return $user_image;
}


