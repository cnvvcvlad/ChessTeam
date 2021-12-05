<?php

namespace Democvidev\ChessTeam\Controller;

use Democvidev\ChessTeam\Model\ArticleManager;
use Democvidev\ChessTeam\Controller\AbstractController;

class PostController extends AbstractController
{
    public function show(int $id)
    {
        return $this->view('posts.show', compact('id'));
    }
    // public function __construct()
    // {
    //     $this->postModel = new Post();
    //     $this->userModel = new User();
    // }

    /**
     * Récupérer les posts selon les paramètres
     *
     * @param int $firstArticle
     * @param int $nbArticlesPerPage
     * @return array
     */
    public function getListe($firstArticle, $nbArticlesPerPage): array
    {
        $art_manager = new ArticleManager();
        $posts = $art_manager->affichageArt($firstArticle, $nbArticlesPerPage);
        return $posts;
    }

    /**
     * Récupérer le nombre de posts
     *
     * @return int
     */
    public function getNbArticles(): int
    {
        $art_manager = new ArticleManager();
        $nbArticles = (int) $art_manager->countArticles();
        return $nbArticles;
    }

    /**
     * Retourne le dernier article
     *
     * @return array
     */
    public function getLastArticles(): array
    {
        $art_manager = new ArticleManager();
        $posts = $art_manager->affichageRecentes();
        return $posts;
    }

    /**
     * Récupérer le dernier article
     *
     * @return array
     */
    public function getLastArticle_one(): array
    {
        $art_manager = new ArticleManager();
        $post = $art_manager->affichageLastOne();
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
        $art_manager = new ArticleManager();
        $posts = $art_manager->affichageParCategorie($category_id);
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
        $art_manager = new ArticleManager();
        $post = $art_manager->affichageOne($art_id);
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
            $art_manager = new ArticleManager();
            $art_manager = $art_manager->AffichageMyArticles($art_author);
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
        $art_manager = new ArticleManager();
        $posts = $art_manager->AffichageMyArticles($id_user);
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
        $art_manager = new ArticleManager();
        $art_manager->deleteArticle($id_article);
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
        // On remplace les caractères indésiables par des chaines de caractères vides
        $element = preg_replace('#[^a-z çéèàùêôî?0-9]#i', '', $element);
        $art_manager = new ArticleManager();
        $posts = $art_manager->searchArticles($element);
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
}
