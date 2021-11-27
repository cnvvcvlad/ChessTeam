<?php

namespace Democvidev\ChessTeam\Controller;

use Democvidev\ChessTeam\Model\CoachManager;

class CoachController
{
    // Headers requis
    // header('Access-Control-Allow-Origin: *');
    // header('Content-Type: application/json; charset=UTF-8');
    // header('Access-Control-Allow-Methods: GET');
    // header('Access-Control-Max-Age: 3600');
    // header(
    //     'Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With'
    // );

    /**
     * Récupère les coordonnées de la ville d'un coach
     *
     * @param string $city
     * @return void
     */
    public function getCoordinateAdress(string $city): void
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $coach_manager = new CoachManager();
            $coachsAdress = $coach_manager->getCoachesByCity($city);
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
            $coach_manager = new CoachManager();
            $coachsAdress = $coach_manager->getAllCoaches();
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
        $coach_manager = new CoachManager();
        $coach = $coach_manager->getInfoCoach($id_coach);
        return $coach;
    }

    /**
     * Récupère les informations des meilleurs coachs
     *
     * @return array
     */
    public function getTopCoachs(): array
    {
        $coach_manager = new CoachManager();
        $coachs = $coach_manager->getInfoTopCoachs();
        return $coachs;
    }
}
