<?php

namespace Democvidev\ChessTeam\Controller;

use Democvidev\ChessTeam\Model\ArticleManager;
use Democvidev\ChessTeam\Controller\AbstractController;

class HomeController extends AbstractController
{
    private $articleManager;
    public function __construct()
    {
        $this->articleManager = new ArticleManager();
    }
    public function index()
    {
        $lastArticles = $this->articleManager->affichageRecentes();
        $lastArticle_one = $this->articleManager->affichageLastOne();        
        return $this->view('home.index', [
            'lastArticles' => $lastArticles,
            'lastArticle_one' => $lastArticle_one
        ]);
    }
}