<?php

namespace Democvidev\ChessTeam\Controller;

use Democvidev\ChessTeam\Model\ArticleManager;
use Democvidev\ChessTeam\Model\CommentsManager;
use Democvidev\ChessTeam\Model\CategoriesManager;
use Democvidev\ChessTeam\Controller\AbstractController;

class HomeController extends AbstractController
{
    protected $articleManager;
    private $offset = 40;
    private $limit = 5;
    private $id_post = 77;
    protected $commentManager;
    protected $categorieManager;

    public function __construct()
    {
        parent::__construct();
        $this->articleManager = new ArticleManager($this->getDatabase());
        $this->commentManager = new CommentsManager($this->getDatabase());
        $this->categorieManager = new CategoriesManager($this->getDatabase());        
    }

    public function index()
    {
        $lastArticles = $this->articleManager->affichageRecentes($this->offset, $this->limit);
        $lastArticle_one = $this->articleManager->affichageOne($this->id_post);
        $commentsOfArticle = $this->commentManager->showCommentsOfArticle($lastArticle_one[0]->getId());        
        return $this->view('home.index', [
            'lastArticles' => $lastArticles,
            'lastArticle_one' => $lastArticle_one,
            'commentsOfArticle' => $commentsOfArticle
        ]);
    }

    public function questions()
    {
        return $this->view('home.questions');
    }
}
