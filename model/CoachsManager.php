<?php

require_once 'DataBase.php';

class CoachsManager extends DataBase
{
    private $table = 'coachs';

    public function getDataBase()
    {
        return $this->database;
    }

    public function setDataBase($database)
    {
        $this->database = $database;
    }

    /**
     * Lecture des agences
     *
     * @return void
     */
    public function getAllCoaches()
    {
        // On écrit la requête
        $request = 'SELECT * FROM ' . $this->table;
        // On prépare la requête
        $select = $this->dbConnect()->prepare($request);
        // On exécute la requête
        $select->execute();
        // On initialise le tableau associatif de résultats
        $coachs = [];
        $coachs['coachs'] = [];

        while ($data = $select->fetch(\PDO::FETCH_ASSOC)) {
            // $coachs[] = new Coachs($data);

            extract($data);
            $coach = [
                'id' => $id,
                'first_name' => $first_name,
                'last_name' => $last_name,
                'city' => $city,
                'coach_image' => $coach_image,
                'price' => $price,
                'description' => $description,
                'nb_stars' => $nb_stars,
                'nb_coachings' => $nb_coachings,
                'lat' => $lat,
                'lon' => $lon,
            ];
            $coachs['coachs'][] = $coach;
        }

        // On retourne le résultat
        return $coachs;
    }

    public function getCoachesByCity($city)
    {
        // On écrit la requête
        $request = 'SELECT * FROM ' . $this->table . ' WHERE city = :city';
        // On prépare la requête
        $select = $this->dbConnect()->prepare($request);
        // On exécute la requête
        $select->execute(['city' => $city]);
        // On initialise le tableau associatif de résultats
        $coachs = [];
        $coachs['coachs'] = [];

        while ($data = $select->fetch(\PDO::FETCH_ASSOC)) {
            // $coachs[] = new Coachs($data);

            extract($data);
            $coach = [
                'id' => $id,
                'first_name' => $first_name,
                'last_name' => $last_name,
                'city' => $city,
                'coach_image' => $coach_image,
                'price' => $price,
                'description' => $description,
                'nb_stars' => $nb_stars,
                'nb_coachings' => $nb_coachings,
                'lat' => $lat,
                'lon' => $lon,
            ];
            $coachs['coachs'][] = $coach;
        }

        // On retourne le résultat
        return $coachs;
    }

    public function getInfoCoach($id)
    {
        // On écrit la requête
        $request = 'SELECT * FROM ' . $this->table . ' WHERE id = :id';
        // On prépare la requête
        $select = $this->dbConnect()->prepare($request);
        // On exécute la requête
        $select->execute(['id' => $id]);
        $coach = $select->fetch(\PDO::FETCH_ASSOC);
        // var_dump($coach);
        // exit;
        return $coach;
    }

    public function getInfoTopCoachs()
    {
        $request =
            'SELECT * FROM ' . $this->table . ' ORDER BY id DESC LIMIT 3';
        $select = $this->dbConnect()->prepare($request);
        $select->execute();
        $coachs = [];
        while ($data = $select->fetch(\PDO::FETCH_ASSOC)) {
            extract($data);
            $coach = [
                'id' => $id,
                'first_name' => $first_name,
                'last_name' => $last_name,
                'city' => $city,
                'coach_image' => $coach_image,
                'price' => $price,
                'description' => $description,
                'nb_stars' => $nb_stars,
                'nb_coachings' => $nb_coachings,
                'lat' => $lat,
                'lon' => $lon,
            ];
            $coachs[] = $coach;
        }

        return $coachs;
    }
}
