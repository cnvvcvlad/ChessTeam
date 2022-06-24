<?php

namespace Democvidev\ChessTeam\Controller;

use Democvidev\ChessTeam\Model\CoachManager;
use Democvidev\ChessTeam\Exception\NotFoundException;
use Democvidev\ChessTeam\Controller\AbstractController;

class CoachController extends AbstractController
{
    private $coachManager;

    public function __construct()
    {
        $this->coachManager = new CoachManager($this->getDatabase());
    }
    // Headers requis
    // header('Access-Control-Allow-Origin: *');
    // header('Content-Type: application/json; charset=UTF-8');
    // header('Access-Control-Allow-Methods: GET');
    // header('Access-Control-Max-Age: 3600');
    // header(
    //     'Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With'
    // );

    public function index()
    {
        return $this->view('coach.index', [
            'coaches' => $this->coachManager->getInfoTopCoachs(),
        ]);
    }

    public function show($id)
    {
        if (!preg_match('/^\d+$/', $id)) {
            throw new NotFoundException('Erreur 404');
        }
        return $this->view('coach.show', [
            'coach' => $this->coachManager->getInfoCoach($id),
        ]);
    }

    public function map()
    {
        return $this->view('coach.map', []);
    }

    public function getCoachsByCriteria()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $city = $_POST['city'];
            $price = $_POST['price'];
            $stars = $_POST['stars'];
            $coachings = $_POST['coachings'];
            $coachsAdress = $this->coachManager->findByCriteria(
                $city,
                $price,
                $stars,
                $coachings
            );
            var_dump($coachsAdress);
            exit();
            http_response_code(200);
            echo json_encode($coachsAdress);
        } else {
            http_response_code(405);
            echo json_encode(['message' => "La méthode n'est pas autorisée"]);
        }
        return $this->view('coach.criteria');
    }

    /**
     * Récupère les coordonnées de la ville d'un coach
     *
     * @param string $city
     * @return void
     */
    public function getCoordinateAdress(string $city): void
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $coachsAdress = $this->coachManager->getCoachesByCity($city);
            // var_dump($coachsAdress);
            // exit();
            // On envoie le code réponse 200 OK
            http_response_code(200);
            // On encode en json et on envoie
            echo json_encode($coachsAdress);
        } else {
            // On gère l'erreur
            http_response_code(405);
            echo json_encode(['message' => "La méthode n'est pas autorisée"]);
        }
    }

    /**
     * Récupère toutes les coordonnées des villes des coachs
     *
     * @return void
     */
    public function getAllCoordinateAdress(): void
    {
        // On vérifie que la méthode utilisée est correcte
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $coachsAdress = $this->coachManager->getAllCoaches();
            // var_dump($coachsAdress);
            // exit();
            // On envoie le code réponse 200 OK
            http_response_code(200);
            // On encode en json et on envoie
            echo json_encode($coachsAdress);
            // return $coachsAdress;
        } else {
            // On gère l'erreur
            http_response_code(405);
            echo json_encode(['message' => "La méthode n'est pas autorisée"]);
        }
        // return $coachsAdress;
    }

    /**
     * Récupère les informations d'un coach
     *
     * @param int $id_coach
     * @return array
     */
    public function getCoach($id_coach): array
    {
        $coach = $this->coachManager->getInfoCoach($id_coach);
        return $coach;
    }

    /**
     * Récupère les informations des meilleurs coachs
     *
     * @return array
     */
    public function getTopCoachs(): array
    {
        $coachs = $this->coachManager->getInfoTopCoachs();
        return $coachs;
    }
}
