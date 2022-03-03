<?php

declare(strict_types=1);

namespace Democvidev\ChessTeam\Controller\Admin;

use Democvidev\ChessTeam\Classes\Category;
use Democvidev\ChessTeam\Model\CategoriesManager;
use Democvidev\ChessTeam\Exception\NotFoundException;
use Democvidev\ChessTeam\Controller\AbstractController;

class CategoryController extends AbstractController
{
    /**
     * @const int MAX_SIZE_IMAGE, 2 Mo
     */
    const MAX_SIZE_IMAGE = 2097152;

    const MAX_LENGTH_IMAGE = 25;

    /**
     * @var array $extensions_valides
     */
    private $extensions_valides = ['jpg', 'jpeg', 'png', 'gif'];
    /**
     * Instance of CategoriesManager
     *
     * @var CategoriesManager
     */
    private $categoryManager;

    /**
     * Initialize the CategoryController
     */
    public function __construct()
    {
        $this->categoryManager = new CategoriesManager($this->getDatabase());
    }

    /**
     * Get all categories and return the display
     *
     * @return void
     */
    public function index()
    {
        $this->isAdmin();
        $categories = $this->categoryManager->showAllCategory();
        return $this->view('admin.categories.index', [
            'categories' => $categories,
        ]);
    }

    /**
     * Get the form to create a new category
     *
     * @return void
     */
    public function create()
    {
        $this->isAdmin();
        return $this->view('admin.categories.form');
    }

    /**
     * Create a new category
     *
     * @return void
     */
    public function createCategory()
    {
        $this->isAdmin();
        if (!empty($_POST) || !empty($_FILES)) {
            extract($_POST);
            // var_dump($_POST);
            // exit;
            // TODO: validation
            if (
                isset($_FILES['image_category']) and
                $_FILES['image_category']['error'] == 0 and
                !empty($_FILES['image_category']['name'])
            ) {
                $image_category = $_FILES['image_category']['name'];
                if (strlen($image_category) > self::MAX_LENGTH_IMAGE) {
                    throw new NotFoundException(
                        'Le nom de l\'image est trop long, il doit faire moins de 25 caractères'
                    );
                }
                if ($_FILES['image_category']['size'] > self::MAX_SIZE_IMAGE) {
                    throw new NotFoundException(
                        'L\'image est trop lourde, elle doit faire moins de 2 Mo'
                    );
                }
                $extension_upload = strtolower(
                    substr(strrchr($_FILES['image_category']['name'], '.'), 1)
                );
                if (!in_array($extension_upload, $this->extensions_valides)) {
                    throw new NotFoundException(
                        'L\'extension de l\'image n\'est pas valide, elle doit être jpg, jpeg, png ou gif'
                    );
                }
                $uploads_dir = dirname(__FILE__, 4) . '/public/img/uploads/';
                $isUploaded = move_uploaded_file(
                    $_FILES['image_category']['tmp_name'],
                    $uploads_dir . $image_category
                );                
                if (!$isUploaded) {
                    throw new NotFoundException(
                        'L\'image n\'a pas pu être uploadée'
                    );
                }
                $cat_author = $_SESSION['id_user'] ?? 235;
                $isEntered = $this->categoryManager->insertCategory(
                    new Category([
                        'title' => $cat_title,
                        'description' => $cat_description,
                        'category_image' => $image_category,
                        'cat_author' => $cat_author,
                    ])
                );
                if (!$isEntered) {
                    throw new NotFoundException(
                        'Une erreur est survenue lors de l\'insertion de la catégorie'
                    );
                }
                return header(
                    'Location:' . dirname(SCRIPTS) . '/admin/categories'
                );
            } else {
                throw new NotFoundException(
                    'Une erreur est survenue lors de l\'upload de l\'image'
                );
            }
        } else {
            throw new NotFoundException('Aucune donnée reçue');
        }
    }

    /**
     * Get the form to edit a category
     *
     * @param int $id_category
     * @return void
     */
    public function edit(int $id_category)
    {
        $this->isAdmin();
        $category = $this->categoryManager->showCategory($id_category);
        if ($category) {
            return $this->view('admin.categories.form', [
                'category' => $category,
            ]);
        } else {
            throw new NotFoundException('Cette catégorie n\'existe pas');
        }
    }

    /**
     * Edit a category
     *
     * @param int $id_category
     * @return void
     */
    public function editCategory(int $id_category)
    {
        $this->isAdmin();
        if (!empty($_POST) || !empty($_FILES)) {
            extract($_POST);
            if ($_FILES['image_category']['name'] == '') {
                $cat_image = $_POST['old_image'];
            } elseif (
                isset($_FILES['image_category']) and
                $_FILES['image_category']['error'] == 0 and
                !empty($_FILES['image_category']['name'])
            ) {
                $cat_image = $_FILES['image_category']['name'];
                if (strlen($cat_image) > self::MAX_LENGTH_IMAGE) {
                    throw new NotFoundException(
                        'Le nom de l\'image est trop long, il doit faire moins de 25 caractères'
                    );
                }
                $old_image = $_POST['old_image'];
                if ($_FILES['image_category']['size'] > self::MAX_SIZE_IMAGE) {
                    throw new NotFoundException(
                        'L\'image est trop lourde, elle doit faire moins de 2 Mo'
                    );
                }
                $info = pathinfo($_FILES['image_category']['name']);
                $extension_upload = strtolower($info['extension']);
                $fileName = $info['filename'];                
                $uploads_dir = dirname(__FILE__, 4) . '/public/img/uploads/';
                if (in_array($extension_upload, $this->extensions_valides)) {
                    if (
                        file_exists($uploads_dir . $old_image) and
                        $old_image != ''
                    ) {
                        $isDeleted = unlink($uploads_dir . $old_image);
                        if (!$isDeleted) {
                            throw new NotFoundException(
                                'Une erreur est survenue lors de la suppression de l\'image antérieure'
                            );
                        }
                    }
                    $new_image =
                        $fileName . md5(uniqid()) . '.' . $extension_upload;
                    $isUploaded = move_uploaded_file(
                        $_FILES['image_category']['tmp_name'],
                        $uploads_dir . $new_image
                    );
                    if (!$isUploaded) {
                        throw new NotFoundException(
                            'L\'image n\'a pas pu être uploadée'
                        );
                    }
                    $cat_image = $new_image;                    
                } else {
                    throw new NotFoundException(
                        'L\'extension de l\'image n\'est pas valide, elle doit être jpg, jpeg, png ou gif'
                    );
                }
            } else {
                throw new NotFoundException(
                    'Une erreur est survenue lors de l\'upload de l\'image'
                );
            }
            $isUpdated = $this->categoryManager->updateCategory(
                $id,
                new Category([
                    'id' => $id_category,
                    'title' => $cat_title,
                    'description' => $cat_description,
                    'category_image' => $cat_image,
                    'cat_author' => $cat_author,
                ])
            );
            if (!$isUpdated) {
                throw new NotFoundException(
                    'Une erreur est survenue lors de la modification de la catégorie'
                );
            }
            return header('Location:' . dirname(SCRIPTS) . '/admin/categories');
        }
    }

    /**
     * Get the category and return the display
     *
     * @param int $id
     * @return void
     */
    public function show($id)
    {
        $category = $this->categoryManager->showCategory($id);
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
     * Supprime une catégorie
     * @param int $id
     * @return void
     */
    public function delete(int $id)
    {
        $this->isAdmin();
        $category = $this->categoryManager->showCategory($id);
        if ($category) {
            $isDeleted = $this->categoryManager->deleteCat($id);
            if (!$isDeleted) {
                throw new NotFoundException(
                    'Une erreur est survenue lors de la suppression de la catégorie'
                );
            }
            return header('Location:' . dirname(SCRIPTS) . '/admin/categories');
        } else {
            throw new NotFoundException('Cette catégorie n\'existe pas');
        }
    }
}
