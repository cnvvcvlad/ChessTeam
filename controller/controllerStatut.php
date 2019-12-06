<?php

function validate($data)
{
    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);

    if (strlen($data) < 3) {
        throw new Exception("Caractères insuffisants !");
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



