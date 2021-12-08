<?php

namespace Democvidev\ChessTeam\Controller\Admin;

use Democvidev\ChessTeam\Classes\Article;
use Democvidev\ChessTeam\Model\ArticleManager;
use Democvidev\ChessTeam\Exception\NotFoundException;
use Democvidev\ChessTeam\Controller\AbstractController;

class PostController extends AbstractController
{
    /**
     * Instance of ArticleManager
     *
     * @var ArticleManager
     */
    protected $postManager;

    /**
     * Initialize the controller
     */
    public function __construct()
    {
        $this->postManager = new ArticleManager($this->getDatabase());
    }

    /**
     * Récupère et trasmets les articles à la vue
     *
     * @return void
     */
    public function index()
    {
        return $this->view('admin.post.index', [
            'posts' => $this->postManager->getAllPosts(),
        ]);
    }

    /**
     * Récupère et trasmets un article à éditer à la vue
     *
     * @param int $id
     * @return void
     */
    public function edit($id)
    {
        return $this->view('admin.post.edit', [
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
        if (!empty($_POST) || !empty($_FILES)) {
            extract($_POST);
            // TODO: validation
            if (
                isset($_FILES['art_image']) and
                $_FILES['art_image']['error'] == 0
            ) {
                $art_image = $_FILES['art_image']['name'];
                if ($_FILES['art_image']['size'] <= 2000000) {
                    $extension_autorisee = ['jpg', 'jpeg', 'png', 'gif'];
                    $info = pathinfo($_FILES['art_image']['name']);
                    $extension_uploadee = $info['extension'];
                    $uploads_dir = dirname(__FILE__, 4) . '/public/img/uploads';
                    if (in_array($extension_uploadee, $extension_autorisee)) {
                        $art_image = $_FILES['art_image']['name'];
                        move_uploaded_file(
                            $_FILES['art_image']['tmp_name'],
                            "$uploads_dir/$art_image"
                        );
                    } else {
                        throw new NotFoundException(
                            'Veuillez rééssayer avec un autre format !'
                        );
                    }
                } else {
                    throw new NotFoundException(
                        'Votre fichier ne doit pas dépasser 1 Mo !'
                    );
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
            } else {
                throw new NotFoundException('Erreur de l\'upload de l\'image!');
            }
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
        $post = $this->postManager->affichageOne($id);
        if ($post) {
            //    $result = $this->postManager->deleteArticle($id);
            $this->postManager->deleteArticle($id);
        }
        return header('Location:' . dirname(SCRIPTS) . '/admin/posts');
    }
}
