<?php

namespace Democvidev\ChessTeam\Model;

use Democvidev\ChessTeam\Classes\Coach;
use Democvidev\ChessTeam\Model\AbstractModel;

class CoachManager extends AbstractModel
{
    /**
     * Redéfinition de la propriété $table
     *
     * @var string
     */
    protected $table = 'coach';

    /**
     * Récupère toutes les informations des coachs
     *
     * @return array
     */
    public function getAllCoaches(): array
    {
        // On écrit la requête
        $request = 'SELECT * FROM ' . $this->table;
        // On prépare la requête
        $select = $this->db->getPDO()->prepare($request);
        // On exécute la requête
        $select->execute();
        // On initialise le tableau associatif de résultats
        $coachs = [];
        // $coachs['coachs'] = [];

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
            $coachs[] = $coach;
        }

        // On retourne le résultat
        return $coachs;
    }

    /**
     * Récupère les informations d'un coach selon la ville
     *
     * @param [type] $city
     * @return array
     */
    public function getCoachesByCity($city): array
    {
        // On écrit la requête
        $request = 'SELECT * FROM ' . $this->table . ' WHERE city = :city';
        // On prépare la requête
        $select = $this->db->getPDO()->prepare($request);
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
        return $coachs;
    }

    /**
     * Récupère les informations d'un coach selon son id
     *
     * @param int $id
     * @return array
     */
    public function getInfoCoach($id): array
    {
        $request = 'SELECT * FROM ' . $this->table . ' WHERE id = :id';
        $select = $this->db->getPDO()->prepare($request);
        $select->bindValue('id', $id, \PDO::PARAM_INT);
        $select->execute();
        $coach = $select->fetch(\PDO::FETCH_ASSOC);
        return $coach;
    }

    /**
     * Récupère les informations des 3 meilleurs coachs
     *
     * @return array
     */
    public function getInfoTopCoachs(): array
    {
        $request =
            'SELECT * FROM ' . $this->table . ' ORDER BY id DESC LIMIT 3';
        $select = $this->db->getPDO()->prepare($request);
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

    /**
     * Récupère les infos selon les critères
     *
     * @param string $city
     * @param string $price
     * @param string $stars
     * @param string $coachings
     * @return mixed
     */
    public function findByCriteria(
        $city = null,
        $price = null,
        $stars = null,
        $coachings = null
    ): ?array {
        $request = 'SELECT * FROM ' . $this->table;
        $select = $this->db->getPDO()->prepare($request);
        $select->execute();
        $rows = $select->fetch(\PDO::FETCH_NUM);
        if ($rows > 0 && $city != null) {
            $query =
                'SELECT * FROM ' .
                $this->table .
                " WHERE city LIKE '" .
                $city .
                "' ";
            if ($price != null) {
                $query .= 'AND price ' . $price . ' ';
            }
            if ($stars != null) {
                $query .= 'AND nb_stars ' . $stars . ' ';
            }
            if ($coachings != null) {
                $query .= 'AND nb_coachings ' . $coachings . ' ';
            }
            $query .= 'ORDER BY price ';
        } else {
            return null;
        }
        $select = $this->db->getPDO()->prepare($query);
        $select->execute();
        return $select->fetchAll();    
        
        // On initialise le tableau associatif de résultats
        $coachs = [];
        while ($donnees = $select->fetch()) {
            $coachs[] = new Coach($donnees);
        }
        // return $coachs;
    }
}
