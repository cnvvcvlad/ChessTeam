<?php



// Headers requis
// header('Access-Control-Allow-Origin: *');
// header('Content-Type: application/json; charset=UTF-8');
// header('Access-Control-Allow-Methods: GET');
// header('Access-Control-Max-Age: 3600');
// header(
//     'Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With'
// );

function getCoordinateAdress(string $city){    
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        $coach_manager = new CoachsManager();
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

function getAllCoordinateAdress()
{
    // On vérifie que la méthode utilisée est correcte
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        $coach_manager = new CoachsManager();
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


function getCoach($id_coach){
    $coach_manager = new CoachsManager();
    $coach = $coach_manager->getInfoCoach($id_coach);
    return $coach;
}

function getTopCoachs() {
    $coach_manager = new CoachsManager();
    $coachs = $coach_manager->getInfoTopCoachs();
    return $coachs;
}