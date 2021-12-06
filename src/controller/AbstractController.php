<?php

namespace Democvidev\ChessTeam\Controller;

use Democvidev\ChessTeam\Database\DataBaseConnection;

abstract class AbstractController
{   

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
}
