<?php

namespace Democvidev\ChessTeam\Form;

use Democvidev\ChessTeam\Classes\Article;
use Democvidev\ChessTeam\Model\ArticleManager;
use Democvidev\ChessTeam\Service\ValidatorHandler;

class PostForm
{
    private $validator;
    private $manager_article;

    public function __construct()
    {
        $this->validator = new ValidatorHandler();
        $this->manager_article = new ArticleManager();
    }

    public function postForm()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (
                isset($_POST['articleCreation']) and
                isset($_FILES['image_article']) and
                $_FILES['image_article']['error'] == 0
            ) {
                extract($_POST);
                $art_title = $this->validator->valid($art_title);
                $art_description = $this->validator->valid($art_description);
                $art_content = $this->validator->valid($art_content);
                $art_image = $this->validator->validatePhoto(
                    $_FILES['image_article']['name']
                );
                $category_id = htmlspecialchars($_POST['category']);
                $art_author = htmlspecialchars($_SESSION['id_user']);
                if ($_FILES['image_article']['size'] <= 2000000) {
                    $extension_autorisee = ['jpg', 'jpeg', 'png', 'gif'];
                    $info = pathinfo($_FILES['image_article']['name']);
                    $extension_uploadee = $info['extension'];
                    if (in_array($extension_uploadee, $extension_autorisee)) {
                        $post_image = $_FILES['image_article']['name'];
                        move_uploaded_file(
                            $_FILES['image_article']['tmp_name'],
                            'assets/img/uploads/' . $post_image
                        );
                        $this->manager_article->insertArticle(
                            new Article([
                                'category_id' => $category_id,
                                'art_title' => $art_title,
                                'art_description' => $art_description,
                                'art_content' => $art_content,
                                'art_author' => $art_author,
                                'art_image' => $art_image,
                            ])
                        );
                        // header('location:index.php?action=allArticles');
                        header(
                            'location:index.php?action=myArticlesId&id=' .
                                $_SESSION['id_user']
                        );
                        exit();
                    } else {
                        throw new \Exception('Extension non autorisée !');
                    }
                } else {
                    throw new \Exception(
                        'La taille de votre fichier doit etre inférieure à 1Mo !'
                    );
                }
            }
        }
    }
}
