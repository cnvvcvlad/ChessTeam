<?php

namespace Democvidev\ChessTeam\Exception;

use Throwable;

class NotFoundException extends \Exception
{
    public function __construct($message = "", $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function error_404($message)
    {
        http_response_code(404);
        $ex = "<h1>{$message}</h1>";
        require VIEWS . 'errors/404.php';
    }
}