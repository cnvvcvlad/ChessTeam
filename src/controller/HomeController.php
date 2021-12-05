<?php

namespace Democvidev\ChessTeam\Controller;

use Democvidev\ChessTeam\Controller\AbstractController;

class HomeController extends AbstractController
{
    public function index()
    {
        return $this->view('home.index');
    }
}