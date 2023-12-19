<?php

namespace Democvidev\ChessTeam\Controller;

use Democvidev\ChessTeam\Model\ArticleManager;
use Democvidev\ChessTeam\Model\CommentsManager;
use Democvidev\ChessTeam\Controller\CommentController;
use Democvidev\ChessTeam\Controller\AbstractController;
use Democvidev\ChessTeam\Exception\NotFoundException;

class PostController extends AbstractController
{
    /**
     * On stocke l'instance de la classe ArticleManager dans une variable
     *
     * @var object
     */
    private $postManager;
    private $commentManager;
    private $commentController;

    /**
     * Initialise les instances necessaires pour l'affichage des articles
     */
    public function __construct()
    {
        parent::__construct();
        $this->postManager = new ArticleManager($this->getDatabase());
        $this->commentManager = new CommentsManager($this->getDatabase());
        $this->commentController = new CommentController();
    }

    /**
     * Récupère tous les articles et les transmet à la vue avec une instance de la classe commentController
     *
     * @return void
     */
    public function index()
    {
        return $this->view('posts.index', [
            'posts' => $this->postManager->getAllPosts(),
            'comment' => $this->commentController
        ]);
    }

    public function show($id)
    {
        if (!preg_match("/^\d+$/", $id)) {
            throw new NotFoundException('Erreur 404');
        }
        $post = $this->postManager->affichageOne($id);
        $commentsOfArticle = $this->commentManager->showCommentsOfArticle($id);
        // var_dump($post[0]->getCategory_id());
        // exit;
        return $this->view('posts.show', compact('post', 'commentsOfArticle'));
    }

    public function showNameAuthor($id): string
    {
        if ($id === null) {
            return 'Directeur';
        }
        if (!preg_match("/^\d+$/", $id)) {
            throw new NotFoundException('Erreur 404');
        }
        $name = $this->postManager->getNameAuthor($id);
        return $name;
    }

    public function showNameCategory($id): string
    {
        if (!preg_match("/^\d+$/", $id)) {
            throw new NotFoundException('Erreur 404');
        }
        $name = $this->postManager->getNameCategory($id);
        return $name;
    }

    public function profilePosts()
    {
        $this->isConnected();
        return $this->view('user.posts', [
            'posts' => $this->postManager->affichageMyArticles($_SESSION['id_user']),
            'comment' => $this->commentController
        ]);
    }

    public function showCategoryPosts(int $id)
    {
        $posts = $this->postManager->affichageParCategorie($id);
        $comment = $this->commentController;
        return $this->view('posts.category', compact('posts', 'comment'));
    }

    /**
     * Récupérer les posts selon les paramètres
     *
     * @param int $firstArticle
     * @param int $nbArticlesPerPage
     * @return array
     */
    public function getListe($firstArticle, $nbArticlesPerPage): array
    {
        $posts = $this->postManager->affichageArt($firstArticle, $nbArticlesPerPage);
        return $posts;
    }

    /**
     * Récupérer le nombre de posts
     *
     * @return int
     */
    public function getNbArticles(): int
    {
        $nbArticles = (int) $this->postManager->countArticles();
        return $nbArticles;
    }

    /**
     * Retourne le dernier article
     *
     * @return array
     */
    public function getLastArticles(): array
    {
        $posts = $this->postManager->affichageRecentes();
        return $posts;
    }

    /**
     * Récupérer le dernier article
     *
     * @return array
     */
    public function getLastArticle_one(): array
    {
        $post = $this->postManager->affichageLastOne();
        return $post;
    }

    /**
     * Récupérer les posts d'une catégorie
     *
     * @param int $category_id
     * @return array
     */
    public function getArticlesOfCategory($category_id): array
    {
        $posts = $this->postManager->affichageParCategorie($category_id);
        return $posts;
    }

    /**
     * Récupérer un seul post
     *
     * @param int $art_id
     * @return array
     */
    public function getOneArticle($art_id): array
    {
        $post = $this->postManager->affichageOne($art_id);
        return $post;
    }

    /**
     * Vérifier si l'utilisateur est auteur d'un article
     *
     * @param int $art_author
     * @return boolean
     */
    public function isAuthor($art_author): bool
    {
        $isAuthor = false;
        if (isset($_SESSION['id_user'])) {
            $art_manager = $this->postManager->AffichageMyArticles($art_author);
            foreach ($art_manager as $key => $value) {
                $value->getArt_author();
            }
            if ($_SESSION['id_user'] == $value->getArt_author()) {
                $isAuthor = true;
            }
        }
        return $isAuthor;
    }

    /**
     * Récupérer les posts d'un auteur
     *
     * @param int $id_user
     * @return array
     */
    public function getMyArticles($id_user): array
    {
        $posts = $this->postManager->AffichageMyArticles($id_user);
        return $posts;
    }

    /**
     * Supprimer un article
     *
     * @param int $id_article
     * @return void
     */
    public function deleteMyArticle($id_article): void
    {
        $this->postManager->deleteArticle($id_article);
        header('location:index.php?action=allArticles');
    }

    /**
     * Rechercher une chaîne de caractères dans les posts
     *
     * @param string $element
     * @return array
     */
    public function searchOneElement($element): array
    {
        // On remplace les caractères indésirables par des chaines de caractères vides
        $element = preg_replace('#[^a-z çéèàùêôî?0-9]#i', '', $element);
        $posts = $this->postManager->searchArticles($element);
        return $posts;
    }

    /**
     * Rechercher une chaîne de caractères dans les posts de manière plus précise
     *
     * @param string $search
     * @return array
     */
    public function getPostsSearchResults($search): array
    {
        $posts = $this->searchOneElement($search);

        // On sépare la chaine en plusieurs éléments
        if (empty($posts)) {
            $posts = [];
            $searchArray = explode(' ', $search);
            usort($searchArray, function ($a, $b) {
                return strlen($b) <=> strlen($a);
            });
            $sortedArray = array_filter($searchArray, function ($word) {
                return strlen($word) > 2;
            });
            foreach ($sortedArray as $key => $value) {
                $posts += $this->searchOneElement($value);
            }
        }
        return $posts;
    }

    public function search()
    {
        $search = $_POST['search'];
        $posts = $this->getPostsSearchResults($search);
        return $this->view('posts.search', compact('posts'));
    }
}
