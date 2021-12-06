<?php

namespace Democvidev\ChessTeam\Controller;

use Democvidev\ChessTeam\Model\ArticleManager;
use Democvidev\ChessTeam\Controller\AbstractController;

class HomeController extends AbstractController
{
    private $articleManager;
    private $offset = 40;
    private $limit = 5;
    private $id_post = 77;

    public function __construct()
    {
        $this->articleManager = new ArticleManager($this->getDatabase());
    }

    public function index()
    {
        $lastArticles = $this->articleManager->affichageRecentes($this->offset, $this->limit);
        $lastArticle_one = $this->articleManager->affichageOne($this->id_post);        
        return $this->view('home.index', [
            'lastArticles' => $lastArticles,
            'lastArticle_one' => $lastArticle_one
        ]);
    }
}