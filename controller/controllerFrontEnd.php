<?php

session_start();
require 'controllerStatut.php';
require '../model/MemberManager.php';
require '../classes/Users.php';
require '../model/CategoriesManager.php';
require '../classes/Category.php';
require '../model/ArticleManager.php';
require '../classes/Article.php';
require '../model/CommentsManager.php';
require '../classes/Comment.php';


$manager_user = new MemberManager();

$manager_category = new CategoriesManager();

$manager_article = new ArticleManager();

$manager_comment = new CommentsManager();


try {

    if (isset($_GET['action'])) {
        session_destroy();
        header('location:./');
        exit();
    }

    /**************Connexion Inscription Update User *************/


    if (isset($_POST['connexion'])) {
        sleep(1);
        $login = validate($_POST['login']);
        $password = $manager_user->checkPassword($login, new MemberManager());

        $passwordHash = $password['password'];
        $passwordUser = validate($_POST['password']);

        if (password_verify($passwordUser, $passwordHash)) {

            $manager_user->log($login, $passwordHash);

            header('location:../index.php?action=connected');
            exit();
        }
        throw new Exception("Le mot de passe est invalide !");

    } elseif (isset($_POST['inscription']) and isset($_FILES['image_membre']) and $_FILES['image_membre']['error'] == 0) {
        extract($_POST);


        $login = validate($login);

        $email = emailValidator($email);


        $password = validate($password);
        $password = password_hash($password, PASSWORD_DEFAULT);

        $user_image = photoValidator($_FILES['image_membre']['name']);

        if ($_FILES['image_membre']['size'] <= 2000000) {
            $extension_autorisee = ["jpg", "jpeg", "png", "gif"];

            $info = pathinfo($_FILES['image_membre']['name']);

            $extension_uploadee = $info['extension'];


            if (in_array($extension_uploadee, $extension_autorisee)) {
                $user_image = $_FILES['image_membre']['name'];

                move_uploaded_file($_FILES['image_membre']['tmp_name'], '../assets/img/uploads/' . $user_image);

                $manager_user->insertMembre(new Users([
                    'login' => $login,
                    'email' => $email,
                    'password' => $password,
                    'user_image' => $user_image
                ]));

                if (isAdmin()) {
                    header('location:../index.php?action=allMembers&alert=aded');
                    exit();
                }
                header("location:../index.php?action=connexion&alert=inscrit");
                exit();

            } else {
                throw new Exception("Veuillez rééssayer avec un autre format d'image !");
            }
        } else {
            throw new Exception("Votre fichier ne doit pas dépasser 2 Mo !");
        }


    } elseif ($_FILES['image_membre']['error'] != 0) {
        throw new Exception ('Veuillez télécharger une image ');
    } elseif (isset($_POST['update'])) {

        extract($_POST);
        $id_user = htmlspecialchars($id_user);

        $login = validate($login);

        $email = validate($email);

        $password = validate($password);

        if (isset($_FILES['user_image']) AND $_FILES['user_image']['error'] == 0) {

            $user_image = validate($_FILES['user_image']['name']);

            if ($_FILES['user_image']['size'] <= 2000000) {
                $extension_autorisee = ["jpg", "jpeg", "png", "gif"];

                $info = pathinfo($_FILES['user_image']['name']);

                $extension_uploadee = $info['extension'];


                if (in_array($extension_uploadee, $extension_autorisee)) {
                    $user_image = $_FILES['user_image']['name'];

                    move_uploaded_file($_FILES['user_image']['tmp_name'], '../assets/img/uploads/' . $user_image);


                } else {
                    throw new Exception("Veuillez rééssayer avec un autre format !");
                }
            } else {
                throw new Exception("Votre fichier ne doit pas dépasser 1 Mo !");
            }

        }
        $manager_user->updateMembre($id_user, new Users([
            'login' => $login,
            'email' => $email,
            'password' => $password,
            'user_image' => $user_image
        ]));


        header("location:../index.php?action=home");
        exit();

    } /************Add Update Category *************/

    elseif (isset($_POST['categoryCreation']) and isset($_FILES['image_category']) and $_FILES['image_category']['error'] == 0) {
        extract($_POST);

        $cat_title = validate($cat_title);
        $cat_description = validate($cat_description);
        $category_image = validate($_FILES['image_category']['name']);
        $cat_author = htmlspecialchars($_SESSION['id_user']);

        if ($_FILES['image_category']['size'] <= 2000000) {
            $extention_autorisee = ["jpg", "jpeg", "png", "gif"];

            $info = pathinfo($_FILES['image_category']['name']);
            $extension_uploadee = $info['extension'];

            if (in_array($extension_uploadee, $extention_autorisee)) {
                $category_image = $_FILES['image_category']['name'];

                move_uploaded_file($_FILES['image_category']['tmp_name'], '../assets/img/uploads/' . $category_image);

                $manager_category->insertCategory(new Category([
                    'title' => $cat_title,
                    'description' => $cat_description,
                    'cat_author' => $cat_author,
                    'category_image' => $category_image
                ]));

                header("location: ../index.php?action=allCategory");
                exit();

            } else {
                throw new Exception("Veuillez rééssayer avec un autre format !");
            }
        } else {
            throw new Exception("Votre fichier ne doit pas dépasser 1 Mo !");
        }
    } elseif (isset($_POST['updateCategory'])) {
        extract($_POST);

        $id = htmlspecialchars($id);
        $cat_author = htmlspecialchars($cat_author);
        $title = validate($title);
        $description = htmlspecialchars($description);


        if (isset($_FILES['category_image']) AND $_FILES['category_image']['error'] == 0) {

            $category_image = validate($_FILES['category_image']['name']);

            if ($_FILES['category_image']['size'] <= 2000000) {
                $extension_autorisee = ["jpg", "jpeg", "png", "gif"];

                $info = pathinfo($_FILES['category_image']['name']);

                $extension_uploadee = $info['extension'];


                if (in_array($extension_uploadee, $extension_autorisee)) {
                    $category_image = $_FILES['category_image']['name'];

                    move_uploaded_file($_FILES['category_image']['tmp_name'], '../assets/img/uploads/' . $category_image);


                } else {
                    throw new Exception("Veuillez rééssayer avec un autre format !");
                }
            } else {
                throw new Exception("Votre fichier ne doit pas dépasser 1 Mo !");
            }

        }
        $manager_category->updateCategory($id, new Category([
            'title' => $title,
            'description' => $description,
            'category_image' => $category_image,
            'cat_author' => $cat_author
        ]));

        header("location:../index.php?action=allCategory");
        exit();
    } /**************Add Update Article ****************/

    elseif (isset($_POST['articleCreation']) and isset($_FILES['image_article']) and $_FILES['image_article']['error'] == 0) {
        extract($_POST);

        $art_title = validate($art_title);
        $art_description = validate($art_description);
        $art_content = validate($art_content);
        $art_image = photoValidator($_FILES['image_article']['name']);
        $category_id = htmlspecialchars($_POST['category']);
        $art_author = htmlspecialchars($_SESSION['id_user']);

        if ($_FILES['image_article']['size'] <= 2000000) {
            $extension_autorisee = ["jpg", "jpeg", "png", "gif"];

            $info = pathinfo($_FILES['image_article']['name']);
            $extension_uploadee = $info['extension'];

            if (in_array($extension_uploadee, $extension_autorisee)) {
                $post_image = $_FILES['image_article']['name'];

                move_uploaded_file($_FILES['image_article']['tmp_name'], '../assets/img/uploads/' . $post_image);

                $manager_article->insertArticle(new Article([
                    'category_id' => $category_id,
                    'art_title' => $art_title,
                    'art_description' => $art_description,
                    'art_content' => $art_content,
                    'art_author' => $art_author,
                    'art_image' => $art_image
                ]));

                header("location: ../index.php?action=allArticles");
                exit();

            } else {
                throw new Exception("Extension non autorisée !");
            }
        } else {
            throw new Exception("La taille de votre fichier doit etre inférieure à 1Mo !");
        }
    } elseif (isset($_POST['updateArticle'])) {
//        var_dump($_POST);
//        var_dump($_FILES);
        extract($_POST);

        $id = htmlspecialchars($id);
        $art_author = htmlspecialchars($art_author);
        $art_title = htmlspecialchars($art_title);
        $art_description = htmlspecialchars($art_description);
        $art_content = htmlspecialchars($art_content);
        $category_id = htmlspecialchars($category_id);


        if (isset($_FILES['art_image']) AND $_FILES['art_image']['error'] == 0) {

            $art_image = photoValidator($_FILES['art_image']['name']);

            if ($_FILES['art_image']['size'] <= 2000000) {
                $extension_autorisee = ["jpg", "jpeg", "png", "gif"];

                $info = pathinfo($_FILES['art_image']['name']);

                $extension_uploadee = $info['extension'];


                if (in_array($extension_uploadee, $extension_autorisee)) {
                    $art_image = $_FILES['art_image']['name'];

                    move_uploaded_file($_FILES['art_image']['tmp_name'], '../assets/img/uploads/' . $art_image);


                } else {
                    throw new Exception("Veuillez rééssayer avec un autre format !");
                }
            } else {
                throw new Exception("Votre fichier ne doit pas dépasser 1 Mo !");
            }


            $manager_article->updateArticle($id, new Article([
                'art_title' => $art_title,
                'art_description' => $art_description,
                'art_image' => $art_image,
                'art_author' => $art_author,
                'art_content' => $art_content,
                'category_id' => $category_id
            ]));

            header("location:../index.php?action=allArticles");
            exit();
        }
    } /************Add Comments ****************/

    elseif (isset($_POST['commentCreation'])) {
        $com_author = htmlspecialchars($_SESSION['id_user']);
        $com_content = validate($_POST['com_content']);
        $article_id = htmlspecialchars($_POST['article_id']);

        $manager_comment->insertComment(new Comment([
            'com_author' => $com_author,
            'com_content' => $com_content,
            'article_id' => $article_id
        ]));

        $url = $_SERVER['HTTP_REFERER'];
        $url_referer = basename($url);
        var_dump($url);
        var_dump($url_referer);
        header("location: ../" . basename($_SERVER['HTTP_REFERER']));
        exit();
    }

} catch (Exception $e) {
    $ex = 'Erreur : ' . $e->getMessage();
    require '../vue/vueException.php';
}








