<?php

namespace Democvidev\ChessTeam\Controller;

use Democvidev\ChessTeam\Classes\ArticleStatut;
use Democvidev\ChessTeam\Model\ArticleManager;
use Democvidev\ChessTeam\Model\CommentsManager;
use Democvidev\ChessTeam\Service\PaginatorHandler;
use Democvidev\ChessTeam\Controller\UserController;
use Democvidev\ChessTeam\Exception\NotFoundException;
use Democvidev\ChessTeam\Controller\CommentController;
use Democvidev\ChessTeam\Controller\AbstractController;
use Democvidev\ChessTeam\Controller\CategoryController;

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
    private $userController;
    protected $categoryController;
    private $paginatorHandler;
    // on determine le nombre d'articles par page
    const POSTS_PER_PAGE = 3;

    /**
     * Initialise les instances necessaires pour l'affichage des articles
     */
    public function __construct()
    {
        parent::__construct();
        $this->postManager = new ArticleManager($this->getDatabase());
        $this->commentManager = new CommentsManager($this->getDatabase());
        $this->userController = new UserController($this->getDatabase());
        $this->categoryController = new CategoryController($this->getDatabase());
        $this->commentController = new CommentController();
        $this->paginatorHandler = new PaginatorHandler($this->postManager);
    }

    /**
     * Get all posts and return the display
     *
     * @return void
     */
    public function index()
    {
        $postsPerPage = self::POSTS_PER_PAGE;
        $currentPage = $this->getCurrentPage();
        // on calcule le nombre de toutes les articles
        $nbPosts = $this->postManager->countArticles(ArticleStatut::PUBLISHED);
        // on calcule le premier article de la page courante
        $posts = $this->paginatorHandler->paginate($currentPage, $postsPerPage, $nbPosts, ArticleStatut::PUBLISHED);
        return $this->view('posts.index', [
            // 'posts' => $this->postManager->getAllPosts(),
            'posts' => $posts,
            'comment' => $this->commentController,
            'pagination' => [
                'currentPage' => $currentPage,
                'nbPages' => $this->paginatorHandler->getNbPages($postsPerPage),
                'nbPosts' => $nbPosts,
                'postsPerPage' => $postsPerPage
            ]
        ]);
    }

    /**
     * on determine sur quelle page des articles on se trouve en verifiant si la page n'est pas vide
     *
     * @return integer
     */
    private function getCurrentPage(): int
    {
        if (isset($_GET['page']) && !empty($_GET['page']) && is_numeric($_GET['page'])) {
            return (int)strip_tags(trim($_GET['page']));
        } else {
            return 1;
        }
    }

    public function show($id)
    {
        if (!preg_match("/^\d+$/", $id)) {
            throw new NotFoundException('Erreur 404');
        }
        $post = $this->postManager->affichageOne($id);
        // Sécuriser l'affichage des articles pour empêcher les utilisateurs non autorisés d’accéder aux articles en brouillon (draft), privés, ou avec un statut non public.        
        if(!$post) {
            throw new NotFoundException("L'article que vous recherchez n'existe pas.", 404);
        }   
        if(isset($_SESSION['statut']) && $_SESSION['statut'] === 1) {
            return $this->view('posts.show', [
                'postStatus' => ArticleStatut::getAllTypes(),
                'post' => $post,
                'commentsOfArticle' => $this->commentManager->showCommentsOfArticle($id)
            ]);
        }
        if($post[0]->getArt_statut() !== ArticleStatut::PUBLISHED && isset($_SESSION['id_user']) && $post[0]->getArt_author() !== $_SESSION['id_user']) {
            throw new NotFoundException("L'article que vous recherchez n'est pas accessible.", 404);
        }
        return $this->view('posts.show', [
            'postStatus' => ArticleStatut::getAllTypes(),
            'post' => $post,
            'commentsOfArticle' => $this->commentManager->showCommentsOfArticle($id)
        ]);
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
        $currentPage = $this->getCurrentPage();
        $postsPerPage = self::POSTS_PER_PAGE;
        $nbPosts = $this->postManager->countMyArticles($_SESSION['id_user']);
        if ($nbPosts == 0) {
            Throw new NotFoundException("Vous n'avez pas des articles publiés");
        }
        $posts = $this->paginatorHandler->paginate($currentPage, $postsPerPage, $nbPosts, $art_statut = null, $_SESSION['id_user']);
        return $this->view('user.posts', [
            'posts' => $posts,
            'comment' => $this->commentController,
            'pagination' => [
                'currentPage' => $currentPage,
                'nbPages' => $this->paginatorHandler->getNbPages($postsPerPage, $_SESSION['id_user']),
                'nbPosts' => $nbPosts,
                'postsPerPage' => $postsPerPage
            ]
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
        $nbArticles = (int) $this->postManager->countArticles(ArticleStatut::PUBLISHED);
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
