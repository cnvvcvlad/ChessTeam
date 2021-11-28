<?php

namespace Democvidev\ChessTeam\Form;

use Democvidev\ChessTeam\Classes\Category;
use Democvidev\ChessTeam\Model\CategoriesManager;
use Democvidev\ChessTeam\Service\ValidatorHandler;

class CategoryForm
{
    private $validator;
    private $manager_category;

    public function __construct()
    {
        $this->validator = new ValidatorHandler();
        $this->manager_category = new CategoriesManager();
    }

    public function categoryForm()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (
                isset($_POST['categoryCreation']) and
                isset($_FILES['image_category']) and
                $_FILES['image_category']['error'] == 0
            ) {
                extract($_POST);
                $cat_title = $this->validator->valid($cat_title);
                $cat_description = $this->validator->valid($cat_description);
                $category_image = $this->validator->valid(
                    $_FILES['image_category']['name']
                );
                $cat_author = htmlspecialchars($_SESSION['id_user']);
                if ($_FILES['image_category']['size'] <= 2000000) {
                    $extention_autorisee = ['jpg', 'jpeg', 'png', 'gif'];
                    $info = pathinfo($_FILES['image_category']['name']);
                    $extension_uploadee = $info['extension'];
                    if (in_array($extension_uploadee, $extention_autorisee)) {
                        $category_image = $_FILES['image_category']['name'];
                        move_uploaded_file(
                            $_FILES['image_category']['tmp_name'],
                            'assets/img/uploads/' . $category_image
                        );
                        $this->manager_category->insertCategory(
                            new Category([
                                'title' => $cat_title,
                                'description' => $cat_description,
                                'cat_author' => $cat_author,
                                'category_image' => $category_image,
                            ])
                        );
                        header('location:index.php?action=allCategory');
                        exit();
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
            }
        }
    }
}
