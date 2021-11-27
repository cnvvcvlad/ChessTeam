<?php

namespace Democvidev\ChessTeam\Service;

class RoleHandler
{

    /**
     * Vérifie si le membre est connecté
     *
     * @return boolean
     */
    public function isConnected(): bool
    {
        if (isset($_SESSION['id_user'])) {
            return true;
        }
        return false;
    }

    /**
     * Vérification si le membre est un admin
     *
     * @return boolean
     */
    public function isAdmin(): bool
    {
        if ($this->isConnected() && $_SESSION['statut'] == 1) {
            return true;
        }
        return false;
    }    
}
