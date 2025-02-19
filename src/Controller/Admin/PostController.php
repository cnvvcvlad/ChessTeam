<?php

namespace Democvidev\ChessTeam\Controller\Admin;

use Democvidev\ChessTeam\Classes\Article;
use Democvidev\ChessTeam\Model\ArticleManager;
use Democvidev\ChessTeam\Classes\ArticleStatut;
use Democvidev\ChessTeam\Model\CategoriesManager;
use Democvidev\ChessTeam\Exception\NotFoundException;
use Democvidev\ChessTeam\Controller\AbstractController;

class PostController extends AbstractController
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
     * Instance of ArticleManager
     *
     * @var ArticleManager
     */
    protected $postManager;

    protected $categoryManager;

    /**
     * Initialize the controller
     */
    public function __construct()
    {
        $this->postManager = new ArticleManager($this->getDatabase());
        $this->categoryManager = new CategoriesManager($this->getDatabase());
    }

    /**
     * Récupère et trasmets les articles à la vue
     *
     * @return void
     */
    public function index()
    {
        // protection de l'accès à la page, pour l'admin uniquement
        $this->isAdmin();
        return $this->view('admin.posts.index', [
            'posts' => $this->postManager->getAllPosts(),
            'status' => ArticleStatut::getAllTypes(),
        ]);
    }

    public function create()
    {
        $this->isConnected();
        return $this->view('admin.posts.form', [
            'categories' => $this->categoryManager->showAllCategory(),
        ]);
    }

    public function createPost()
    {
        $this->isConnected();
        if (!empty($_POST) || !empty($_FILES)) {
            extract($_POST);
            // var_dump($_POST);
            // exit;
            // TODO: validation
            if (
                isset($_FILES['art_image']) and
                $_FILES['art_image']['error'] == 0 and
                !empty($_FILES['art_image']['name'])
            ) {
                $art_image = $_FILES['art_image']['name'];
                if (strlen($art_image) > self::MAX_LENGTH_IMAGE) {
                    throw new NotFoundException(
                        'Le nom de l\'image est trop long'
                    );
                }
                if ($_FILES['art_image']['size'] <= self::MAX_SIZE_IMAGE) {
                    // $extensions_valides = ['jpg', 'jpeg', 'png', 'gif'];
                    // $info = pathinfo($_FILES['art_image']['name']);
                    // $extension_uploadee = $info['extension'];
                    $extension_uploadee = strtolower(
                        substr(strrchr($_FILES['art_image']['name'], '.'), 1)
                    );
                    if (
                        in_array($extension_uploadee, $this->extensions_valides)
                    ) {
                        $uploads_dir =
                            dirname(__FILE__, 4) . '/public/img/uploads/';
                        // $art_image = $_FILES['art_image']['name'];
                        $isUploaded = move_uploaded_file(
                            $_FILES['art_image']['tmp_name'],
                            $uploads_dir . $art_image
                        );
                        if (!$isUploaded) {
                            throw new NotFoundException(
                                'Une erreur est survenue lors de l\'upload de l\'image ! Veuillez réessayer.'
                            );
                        }
                    } else {
                        throw new NotFoundException(
                            'Veuillez rééssayer avec un format jpg, jpeg, gif ou png !'
                        );
                    }
                } else {
                    throw new NotFoundException(
                        'Votre fichier ne doit pas dépasser 2 Mo !'
                    );
                }
                // TODO art_author from session
                $art_author = $_SESSION['id_user'];
                isset($art_author) ? ($art_author = $art_author) : 235;
                $isEntered = $this->postManager->insertArticle(
                    new Article([
                        'art_title' => $art_title,
                        'art_description' => $art_description,
                        'art_image' => $art_image,
                        'art_author' => $art_author,
                        'art_content' => $art_content,
                        'category_id' => $category,
                    ])
                );
                if (!$isEntered) {
                    throw new NotFoundException(
                        'Une erreur est survenue lors de l\'insertion de l\'article ! Veuillez réessayer.'
                    );
                }
                return header('Location:' . dirname(SCRIPTS) . '/profile/posts');
            } else {
                throw new NotFoundException('Erreur de l\'upload de l\'image!');
            }
        } else {
            throw new NotFoundException('Aucune donnée reçue');
        }
    }

    /**
     * Récupère et trasmets un article à éditer à la vue
     *
     * @param int $id
     * @return void
     */
    public function edit(int $id)
    {
        $this->isConnected();
        // TODO: éditer ses propres articles soit être admin
        return $this->view('admin.posts.form', [
            'post' => $this->postManager->affichageOne($id),
        ]);
    }

    /**
     * Met à jour un article
     *
     * @param [type] $id
     * @return void
     */
    public function update($id)
    {
        $this->isConnected();
        // TODO: éditer ses propres articles soit être admin
        if (!empty($_POST) || !empty($_FILES)) {
            extract($_POST);
            // TODO: validation
            // var_dump($_POST);
            // exit();
            if ($_FILES['art_image']['name'] == '') {
                $art_image = $_POST['old_image'];
            } elseif (
                isset($_FILES['art_image']) and
                $_FILES['art_image']['error'] == 0 and
                !empty($_FILES['art_image']['name'])
            ) {
                $art_image = $_FILES['art_image']['name'];
                if (strlen($art_image) > self::MAX_LENGTH_IMAGE) {
                    throw new NotFoundException(
                        'Le nom de l\'image est trop long'
                    );
                }
                $old_image = $_POST['old_image'];
                if ($_FILES['art_image']['size'] <= self::MAX_SIZE_IMAGE) {
                    // $extension_autorisee = ['jpg', 'jpeg', 'png', 'gif'];
                    $info = pathinfo($_FILES['art_image']['name']);
                    $extension_uploadee = $info['extension'];
                    $fileName = $info['filename'];
                    $uploads_dir = dirname(__FILE__, 4) . '/public/img/uploads';
                    if (
                        in_array($extension_uploadee, $this->extensions_valides)
                    ) {
                        // 1st Delete old image
                        if (file_exists("$uploads_dir/$old_image") and $old_image != '') {
                            $isDeleted = unlink("$uploads_dir/$old_image");
                            if (!$isDeleted) {
                                throw new NotFoundException(
                                    'Une erreur est survenue lors de la suppression de l\'image ancienne ! Veuillez réessayer.'
                                );
                            }
                        }

                        $new_image =
                            $fileName .
                            md5(uniqid()) .
                            '.' .
                            $extension_uploadee;

                        move_uploaded_file(
                            $_FILES['art_image']['tmp_name'],
                            "$uploads_dir/$new_image"
                        );
                        $art_image = $new_image;
                    } else {
                        throw new NotFoundException(
                            'Veuillez rééssayer avec un autre format !'
                        );
                    }
                } else {
                    throw new NotFoundException(
                        'Votre fichier ne doit pas dépasser 2 Mo !'
                    );
                }
            } else {
                throw new NotFoundException('Erreur de l\'upload de l\'image!');
            }
            $result = $this->postManager->updateArticle(
                $id,
                new Article([
                    'art_title' => $art_title,
                    'art_description' => $art_description,
                    'art_image' => $art_image,
                    'art_author' => $art_author,
                    'art_content' => $art_content,
                    'category_id' => $category_id,
                ])
            );
            if ($result) {
                return header('Location:' . dirname(SCRIPTS) . '/admin/posts');
            }
        } else {
            throw new NotFoundException('Aucune donnée reçue');
        }
    }

    /**
     * Supprime un article
     *
     * @param int $id
     * @return void
     */
    public function destroy($id)
    {
        $this->isAdmin();
        $post = $this->postManager->affichageOne($id);
        if ($post) {
            //    $result = $this->postManager->deleteArticle($id);
            $this->postManager->deleteArticle($id);
        }
        return header('Location:' . dirname(SCRIPTS) . '/admin/posts');
    }

    /**
     * Met à jour le statut d'un article
     *
     * @return void
     */
    public function updateStatus()
    {
        $this->isAdmin();
        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['id'], $_POST['status'])) {
            $id = intval($_POST['id']);
            $status = $_POST['status'];
            if (in_array($status, ArticleStatut::getAllTypes())) {
                $this->postManager->changeStatus($id, $status);
            } else {
                throw new NotFoundException('Erreur. Statut non valide');
            }
        } else {
            throw new NotFoundException('Erreur. Aucune donnée reçue');
        }
        return header('Location:' . dirname(SCRIPTS) . '/admin/posts');
    }
}
