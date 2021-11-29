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
            } elseif (isset($_POST['updateArticle'])) {                
                extract($_POST);        
                $id = htmlspecialchars($id);
                $art_author = htmlspecialchars($art_author);
                $art_title = htmlspecialchars($art_title);
                $art_description = htmlspecialchars($art_description);
                $art_content = htmlspecialchars($art_content);
                $category_id = htmlspecialchars($category_id);        
                if (
                    isset($_FILES['art_image']) and
                    $_FILES['art_image']['error'] == 0
                ) {
                    $art_image = $this->validator->validatePhoto($_FILES['art_image']['name']);        
                    if ($_FILES['art_image']['size'] <= 2000000) {
                        $extension_autorisee = ['jpg', 'jpeg', 'png', 'gif'];        
                        $info = pathinfo($_FILES['art_image']['name']);        
                        $extension_uploadee = $info['extension'];        
                        if (in_array($extension_uploadee, $extension_autorisee)) {
                            $art_image = $_FILES['art_image']['name'];        
                            move_uploaded_file(
                                $_FILES['art_image']['tmp_name'],
                                'assets/img/uploads/' . $art_image
                            );
                        } else {
                            throw new \Exception(
                                'Veuillez rééssayer avec un autre format !'
                            );
                        }
                    } else {
                        throw new \Exception(
                            'Votre fichier ne doit pas dépasser 1 Mo !'
                        );
                    }        
                    $this->manager_article->updateArticle(
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
                    header('location:index.php?action=myArticlesId&id=' . $_SESSION['id_user']);
                    exit();
                }
            }
        }
    }
}
