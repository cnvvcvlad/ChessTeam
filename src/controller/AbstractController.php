<?php

namespace Democvidev\ChessTeam\Controller;

use Democvidev\ChessTeam\Database\DataBaseConnection;
use Democvidev\ChessTeam\Exception\NotFoundException;

abstract class AbstractController
{   
    public function __construct()
    {
        // si on n'a pas de session, on en crée une
        if(session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }
    
    /**
     * Transmit data to the view
     *
     * @param string $path
     * @param array|null $params
     * @return void
     */
    public function view(string $path, array $params =null)
    {
        // bufferisation de la vue
        ob_start();
        $path = str_replace('.', DIRECTORY_SEPARATOR, $path);
        require VIEWS . $path . '.php';
        if(!is_null($params)){
            $params = extract($params);
        }
        $content = ob_get_clean();
        require VIEWS . 'baseLayout.php';
    }

    /**
     * Retourne une instance de la classe DataBaseConnection
     *
     * @return DataBaseConnection
     */
    public function getDatabase(): DataBaseConnection
    {
        return new DataBaseConnection();
    }

    public function isConnected(): bool
    {
        if (isset($_SESSION['id_user']) && !empty($_SESSION['id_user'])) {
            return true;
        } else {
            return header('Location:' . dirname(SCRIPTS) . '/login');
        }
    }

    public function isAdmin(): bool
    {
        if ($this->isConnected() && $_SESSION['statut'] === 1) {
            return true;
        } else {
            throw new NotFoundException('Vous n\'avez pas les droits pour accéder à cette page !');
        }
    }
}
