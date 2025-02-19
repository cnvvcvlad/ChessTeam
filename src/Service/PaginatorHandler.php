<?php

namespace Democvidev\ChessTeam\Service;

use Democvidev\ChessTeam\Model\ArticleManager;
use Democvidev\ChessTeam\Classes\ArticleStatut;
use Democvidev\ChessTeam\Exception\NotFoundException;

class PaginatorHandler
{
    private $postManager;

    public function __construct(
        ArticleManager $postManager
    ) {
        $this->postManager = $postManager;
    }

    /**
     * gestion de la pagination des articles d'une page
     *
     * @param integer $currentPage
     * @param integer $postsPerPage
     * @return array
     */
    public function paginate(int $currentPage, int $postsPerPage, int $nbPosts, $art_statut, int $id = null): array
    {
        // $nbPosts = $this->postManager->countArticles();
        $nbPages = ceil($nbPosts / $postsPerPage);
        $this->validateCurrentPage($currentPage, $nbPages);
        $firstPost = ($currentPage - 1) * $postsPerPage;
        return is_null($id)
            ? $this->postManager->affichageArt($firstPost, $postsPerPage, $art_statut)
            : $this->postManager->affichageMyArt($firstPost, $postsPerPage, $id);
    }

    /**
     * on verifie que la page courante est comprise entre 1 et le nombre de pages totales
     *
     * @param integer $currentPage
     * @param integer $nbPages
     * @return void
     */
    private function validateCurrentPage(int $currentPage, int $nbPages): void
    {
        if ($currentPage < 1 || $currentPage > $nbPages) {
            throw new NotFoundException('Error 404 : Page introuvable');
        }
    }

    /**
     * on calcule le nombre de pages totales
     *
     * @param [type] $postsPerPage
     * @return integer
     */
    public function getNbPages($postsPerPage, $id = null): int
    {
        return ceil($this->getNumberOfPosts($id) / $postsPerPage);
    }

    /**
     * on determine le nombre total d'articles
     *
     * @return integer
     */
    public function getNumberOfPosts($id = null): int
    {
        return is_null($id) ? $this->postManager->countArticles(ArticleStatut::PUBLISHED) : $this->postManager->countMyArticles($id);
    }
}
