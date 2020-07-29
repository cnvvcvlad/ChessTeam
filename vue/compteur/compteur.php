<?php

function add_vue() :void
{
    $file = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'compteur' . DIRECTORY_SEPARATOR . 'compteur';
    $daily_file = $file . '-' . date('Y-m-d');
    incrementer_compteur($file);
    incrementer_compteur($daily_file);
}

function incrementer_compteur(string $file) :void
{
    $compteur = 1;
    if (file_exists($file)) {
        //Si le fichier existe on icrémente
        $compteur = (int)file_get_contents($file);
        $compteur++;
        file_put_contents($file, $compteur);
    } else {
        //Sinon on crée le fichier avec la valeur 1
        file_put_contents($file, '1');
    }
}

function nb_vues() : string
{
    $file = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'compteur' . DIRECTORY_SEPARATOR . 'compteur';
    return file_get_contents($file);
}
