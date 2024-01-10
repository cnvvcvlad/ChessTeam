<?php

namespace Democvidev\ChessTeam\Controller\Admin;

use Democvidev\ChessTeam\Classes\Coach;
use Democvidev\ChessTeam\Model\CoachManager;
use Democvidev\ChessTeam\Exception\NotFoundException;
use Democvidev\ChessTeam\Controller\AbstractController;

class CoachController extends AbstractController
{
    const MAX_SIZE_IMAGE = 2097152;
    const EXTENSIONS_VALIDES = ['jpg', 'jpeg', 'png', 'gif'];
    const MAX_LENGTH_IMAGE = 25;

    private $coachManager;

    public function __construct()
    {
        parent::__construct();
        $this->coachManager = new CoachManager($this->getDatabase());
    }

    public function index()
    {
        $this->isAdmin();
        return $this->view('admin.coachs.index', [
            'coachs' => $this->coachManager->getAllCoaches()
        ]);
    }

    public function create()
    {
        $this->isAdmin();
        return $this->view('admin.coachs.form');
    }

    public function createCoach()
    {
        $this->isAdmin();
        if ($this->isRegistrationRequestValid()) {
            $this->processValidRegistration();
        }
    }

    private function isRegistrationRequestValid()
    {
        if (
            isset($_POST['createCoach']) && isset($_FILES['coach_image'])
            && $_FILES['coach_image']['error'] == 0
        ) {
            // TODO: Ajouter des validations supplémentaires si nécessaire
            return true;
        }
        return false;
    }

    private function processValidRegistration()
    {
        extract($_POST);
        // var_dump($_POST);
        // exit();
        $password = password_hash($password, PASSWORD_DEFAULT);
        if ($_FILES['coach_image']['size'] <= self::MAX_SIZE_IMAGE) {
            $extensions_valides = self::EXTENSIONS_VALIDES;
            $extension_upload = strtolower(substr(strrchr($_FILES['coach_image']['name'], '.'), 1));
            if (in_array($extension_upload, $extensions_valides)) {
                // move_uploaded_file($_FILES['coach_image']['tmp_name'], 'img/coach/' . $coach_image);
                $coach_image = md5(uniqid(rand(), true)) . '.' . $extension_upload;
                $isMoved = $this->moveUploadedFile($coach_image);
                if ($isMoved) {
                    $this->insertCoachIntoDatabase($first_name, $last_name, $email, $password, $city, $coach_image, $price, $description, $nb_stars, $nb_coachings, $lat, $lon);
                    $this->redirectToAfterRegistration();
                } else {
                    throw new \Exception('Le fichier n\'a pas pu être enregistré');
                }
            } else {
                throw new \Exception('Le type de fichier n\'est pas autorisé');
            }
        } else {
            throw new \Exception('Le fichier est trop volumineux et ne doit dépasser ' . self::MAX_SIZE_IMAGE . ' octets!');
        }
    }

    private function moveUploadedFile($coach_image)
    {
        $path = dirname(__FILE__, 4) . '/public/img/uploads/' . $coach_image;
        $isMoved = move_uploaded_file($_FILES['coach_image']['tmp_name'], $path);
        return $isMoved;
    }

    private function insertCoachIntoDatabase(
        $first_name,
        $last_name,
        $email,
        $password,
        $city,
        $coach_image,
        $price,
        $description,
        $nb_stars,
        $nb_coachings,
        $lat,
        $lon
    ) {
        $this->coachManager->insertCoach(new Coach([
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $email,
            'password' => $password,
            'city' => $city,
            'coach_image' => $coach_image,
            'price' => $price,
            'description' => $description,
            'nb_stars' => $nb_stars,
            'nb_coachings' => $nb_coachings,
            'lat' => $lat,
            'lon' => $lon
        ]));
    }

    private function redirectToAfterRegistration()
    {
        $redirectUrl = $this->isAdmin() ? '/admin/coachs' : '/login';
        header('Location:' . dirname(SCRIPTS) . $redirectUrl);
        exit();
    }

    public function edit($id)
    {
        $this->isAdmin();
        return $this->view('admin.coachs.form', [
            'coach' => $this->coachManager->getInfoCoach($id)
        ]);
    }

    public function editCoach($id)
    {
        $this->isAdmin();
        if ($this->isUpdateRequestValid()) {
            $this->processValidUpdate($id);
        }
    }

    private function isUpdateRequestValid()
    {
        if (
            isset($_POST['updateCoach']) && isset($_FILES['coach_image'])
        ) {
            return true;
        }
        return false;
    }

    private function processValidUpdate($id)
    {
        extract($_POST);
        $password = password_hash($password, PASSWORD_DEFAULT);
        if ($_FILES['coach_image']['name'] == '') {
            $coach_image = $_POST['old_coach_image'];
        } elseif (
            isset($_FILES['coach_image']) and
            $_FILES['coach_image']['error'] == 0 and
            !empty($_FILES['coach_image']['name'])
        ) {
            $coach_image = $_FILES['coach_image']['name'];
            if (strlen($coach_image) > self::MAX_LENGTH_IMAGE) {
                throw new \Exception('Le fichier est trop volumineux et ne doit dépasser ' . self::MAX_SIZE_IMAGE . ' octets!');
            }
            $old_coach_image = $_POST['old_coach_image'];
            if ($_FILES['coach_image']['size'] <= self::MAX_SIZE_IMAGE) {
                $extensions_valides = self::EXTENSIONS_VALIDES;
                $extension_upload = strtolower(substr(strrchr($_FILES['coach_image']['name'], '.'), 1));
                $upload_dir = dirname(__FILE__, 4) . '/public/img/uploads/';
                if (in_array($extension_upload, $extensions_valides)) {
                    if (file_exists("$upload_dir/$old_coach_image") && $old_coach_image != '') {
                        $isDeleted = unlink("$upload_dir/$old_coach_image");
                        if (!$isDeleted) {
                            throw new \Exception('Le fichier n\'a pas pu être supprimé');
                        }
                    }
                    $new_coach_image = md5(uniqid(rand(), true)) . '.' . $extension_upload;
                    $isMoved = $this->moveUploadedFile($new_coach_image);
                    if ($isMoved) {
                        $coach_image = $new_coach_image;
                    } else {
                        throw new \Exception('Le fichier n\'a pas pu être enregistré');
                    }
                } else {
                    throw new \Exception('Le type de fichier n\'est pas autorisé');
                }
            } else {
                throw new \Exception('La taille de fichier n\'est pas autorisé. Il doit être inférieure à 2 Mo !');
            }
        } else {
            throw new \Exception('Une erreur est survenue lors de l\'upload de l\'image !');
        }
        $this->updateCoachInDatabase($id, $first_name, $last_name, $email, $city, $coach_image, $price, $description, $nb_stars, $nb_coachings, $lat, $lon);
        $this->redirectToAfterUpdate($id);
    }

    private function updateCoachInDatabase(
        $id,
        $first_name,
        $last_name,
        $email,
        $city,
        $coach_image,
        $price,
        $description,
        $nb_stars,
        $nb_coachings,
        $lat,
        $lon
    ) {
        $result = $this->coachManager->updateCoach(
            $id,
            new Coach([
                'first_name' => $first_name,
                'last_name' => $last_name,
                'email' => $email,
                'city' => $city,
                'coach_image' => $coach_image,
                'price' => $price,
                'description' => $description,
                'nb_stars' => $nb_stars,
                'nb_coachings' => $nb_coachings,
                'lat' => $lat,
                'lon' => $lon
            ])
        );
        if (!$result) {
            throw new \Exception('Une erreur est survenue lors de la mise à jour du coach !');
        }
    }

    private function redirectToAfterUpdate($id)
    {
        $redirectUrl = $this->isAdmin() ? '/admin/coachs/edit/' . $id : '/login';
        header('Location:' . dirname(SCRIPTS) . $redirectUrl);
        exit();
    }

    public function delete($id)
    {
        $this->isAdmin();
        //delete image
        $filename = $this->coachManager->getInfoCoach($id)['coach_image'];
        $upload_dir = dirname(__FILE__, 4) . '/public/img/uploads/';
        if (file_exists("$upload_dir/$filename")) {
            $isDeleted = unlink("$upload_dir/$filename");
            if (!$isDeleted) {
                throw new NotFoundException('Une erreur est survenue lors de la suppression de l\'image !');
            }
        } else {
            throw new NotFoundException('L\'image n\'existe pas !');
        }
        $this->coachManager->deleteCoach($id);
        header('Location:' . dirname(SCRIPTS) . '/admin/coachs');
        exit();
    }
}
