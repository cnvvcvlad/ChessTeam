<?php

namespace Democvidev\ChessTeam\Controller;

use Democvidev\ChessTeam\Service\RoleHandler;
use Democvidev\ChessTeam\Classes\ArticleStatut;
use Democvidev\ChessTeam\Model\CategoriesManager;
use Democvidev\ChessTeam\Controller\AbstractController;
use Democvidev\ChessTeam\Exception\NotFoundException;

class CategoryController extends AbstractController
{

    /**
     * Instance of CategoriesManager
     *
     * @var CategoriesManager
     */
    private $categoryManager;

    /**
     * Instance of RoleHandler
     *
     * @var RoleHandler
     */
    private $handler;

    /**
     * Initialize the CategoryController
     */
    public function __construct()
    {
        parent::__construct();
        $this->categoryManager = new CategoriesManager($this->getDatabase());
        $this->handler = new RoleHandler();
    }

    /**
     * Get all categories and return the display
     *
     * @return void
     */
    public function index()
    {
        $this->handler->isAdmin() ?
            $categories = $this->categoryManager->showAllCategory() :
            $categories = $this->categoryManager->getAllCategoriesByStatus(ArticleStatut::PUBLISHED);
        return $this->view('categories.index', ['categories' => $categories]);
    }

    /**
     * Get the category and return the display
     *
     * @param int $id
     * @return void
     */
    public function show($id)
    {
        if (!preg_match("/^\d+$/", $id)) {
            throw new NotFoundException('Erreur 404');
        }
        if (isset($_SESSION['statut']) && $_SESSION['statut'] === 1) {

            $category = $this->categoryManager->showCategory($id);
        } else {
            $category = $this->categoryManager->getCategoryByStatus(ArticleStatut::PUBLISHED, $id);
        }
        if (!$category) {
            throw new NotFoundException("La catégorie que vous recherchez n'existe pas.", 404);
        }
        return $this->view('categories.show', ['category' => $category]);
    }

    /**
     * Récupère la liste des catégories
     *
     * @return array
     */
    function getAllCategory(): array
    {
        $category = $this->categoryManager->showAllCategory();
        return $category;
    }

    /**
     * Récupérer une catégorie par son id
     *
     * @param int $id_category
     * @return array
     */
    function getCategory($id_category): array
    {
        $category = $this->categoryManager->showCategory($id_category);
        return $category;
    }

    /**
     * Récupérér le nom d'une catégorie par son id
     *
     * @param int $id_category
     * @return string
     */
    function showNameCategory($id_category): string
    {
        $category_name = 'Generique';
        if (!empty($id_category)) {
            $category = $this->categoryManager->nameCategory($id_category);
            $category_name = implode($category);
            return $category_name;
        }
        return $category_name;
    }

    /**
     * Supprimer une catégorie
     *
     * @param int $id_category
     * @return void
     */
    function deleteCategory($id_category): void
    {
        $this->categoryManager->deleteCat($id_category);
        header('location:index.php?action=allCategory');
        exit();
    }
}
