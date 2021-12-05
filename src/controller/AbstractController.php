<?php

namespace Democvidev\ChessTeam\Controller;

class AbstractController
{
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
}