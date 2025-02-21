<?php

namespace Democvidev\ChessTeam\Controller;

use Democvidev\ChessTeam\Classes\Messages;
use Democvidev\ChessTeam\Model\ArticleManager;
use Democvidev\ChessTeam\Model\CommentsManager;
use Democvidev\ChessTeam\Model\MessagesManager;
use Democvidev\ChessTeam\Model\CategoriesManager;
use Democvidev\ChessTeam\Exception\NotFoundException;
use Democvidev\ChessTeam\Controller\AbstractController;

class HomeController extends AbstractController
{
    protected $articleManager;
    private $offset = 40;
    private $limit = 5;
    private $id_post = 77;
    protected $commentManager;
    protected $categorieManager;
    protected $messageManager;

    public function __construct()
    {
        parent::__construct();
        $this->articleManager = new ArticleManager($this->getDatabase());
        $this->commentManager = new CommentsManager($this->getDatabase());
        $this->categorieManager = new CategoriesManager($this->getDatabase());
        $this->messageManager = new MessagesManager($this->getDatabase());
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

    public function conditions()
    {
        return $this->view('home.conditions');
    }

    public function mentions()
    {
        return $this->view('home.mentions');
    }

    public function contact()
    {
        return $this->view('home.contact');
    }

    public function sendContact()
    {
        if (!empty($_POST) && isset($_POST['sendContact'])) {
            extract($_POST);
            $result = $this->messageManager->insertMessage(
                new Messages([
                    'author_name' => $author_name,
                    'mess_author' => $mess_author,
                    'mess_subject' => $mess_subject,
                    'mess_content' => $mess_content,
                ])
            );

            if (!$result) {
                throw new NotFoundException(
                    'Une erreur est survenue lors de l\'insertion du message'
                );
            }
            return header('Location:' . dirname(SCRIPTS) . '/contact');
        }
    }
}
