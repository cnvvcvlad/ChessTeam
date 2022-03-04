<?php

namespace Democvidev\ChessTeam\Core;

class Route
{
    public $path;
    public $action;
    public $matches;
    public function __construct($path, $action)
    {
        $this->path = trim($path, '/');
        $this->action = $action;
    }

    public function matches(string $url)
    {
        $url = trim($url, '/');
        $path = preg_replace('#:([\w]+)#', '([^/]+)', $this->path);
        $path = str_replace('/', '\\/', $path);
        $regex = "#^$path$#i";
        if (preg_match($regex, $url, $matches)) {
            $this->matches = $matches;
            return true;
        }else{
            return false;
        }        
    }

    public function execute()
    {
        if (is_string($this->action)) {
            $params = explode('@', $this->action);
            $controller = $params[0];
            $method = $params[1];
            $controller = new $controller;
            // return call_user_func_array([$controller, $method], $this->matches);
            return isset($this->matches[1]) ? $controller->$method($this->matches[1]) : $controller->$method();
        }else{
            return call_user_func_array($this->action, $this->matches);
        }
    }
}
