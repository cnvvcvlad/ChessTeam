<?php

namespace Democvidev\ChessTeam\Model;

use Democvidev\ChessTeam\Database\DataBaseConnection;

abstract class AbstractModel
{
    /**
     * On stocke le nom de la table pour une gestion dynamique des requêtes
     *
     * @var string
     */
    protected $table;

    /**
     * On stocke l'instance de la classe DataBaseConnection
     *
     * @var DataBaseConnection
     */
    protected $db;
    
    /**
     * On initalise l'objet AbstractModel
     *
     * @param DataBaseConnection $db
     */
    public function __construct(DataBaseConnection $db)
    {
        $this->db = $db;
    }

    public function create(array $data, array $relations = null)
    {
        $firstParenthesis = "";
        $secondParenthesis = "";
        $counter = 1;

        foreach ($data as $key => $value) {
            $comma = $counter === count($data) ? "" : ", ";
            $firstParenthesis .= "{$key}{$comma}";
            $secondParenthesis .= ":{$key}{$comma}";
            $counter++;
        }

        return $this->db->getPDO->query(
            "INSERT INTO {$this->table} ({$firstParenthesis}) VALUES ({$secondParenthesis})", $data);
    }

    /**
     * Récupère toutes les donées de la table, dans une liste de ressources
     *
     * @return \PDOStatement
     */
    public function requestAll(): \PDOStatement    
    {        
        $sql = 'SELECT *, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') 
        AS date_creation FROM ' . $this->table . ' ORDER BY date_creation DESC';
        $stmt = $this->db->getPDO()->prepare($sql);
        $stmt->execute();
        return $stmt;
    }    

    /**
     * Récupère les données d'un enregistrement
     * 
     * @param int $id
     * @return \PDOStatement
     */
    public function requestOneById(int $id): \PDOStatement
    {
        $sql = 'SELECT *, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') 
        AS date_creation FROM ' . $this->table . ' WHERE id = :id';
        $stmt = $this->db->getPDO()->prepare($sql);
        $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt;
    }

    /**
     * Récupère les données de tous les enregistrements d'une table et retourne 
     * un tableau de ressources (objets) de la classe AbstractModel et ses sous-classes
     *
     * @return array
     */
    public function findAll(): array
    {
        $sql = 'SELECT *, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') 
        AS date_creation FROM ' . $this->table . ' ORDER BY date_creation DESC';
        $stmt = $this->db->getPDO()->query($sql);
        // definit le mode de récupération des données en tableau de classe et on lui passe 
        // l'instance de connexion à la base de données
        $stmt->setFetchMode(\PDO::FETCH_CLASS, get_class($this), [$this->db]);
        return $stmt->fetchAll();
    }

    /**
     * Récupère les données d'un enregistrement et retourne un objet de la classe AbstractModel et ses sous-classes
     *
     * @param int $id
     * @return mixed
     */
    public function findOneById(int $id): mixed
    {
        $sql = 'SELECT *, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') 
        AS date_creation FROM ' . $this->table . ' WHERE id = :id';
        $stmt = $this->db->getPDO()->prepare($sql);
        $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_CLASS, get_class($this->className), [$this->db]);
        return $stmt->fetch();
    }

    /**
     * Retourne un tableau avec un seul objet de la classe AbstractModel et ses sous-classes
     */
    public function findById($id)
    {
        return $this->query('SELECT * FROM ' . $this->table . ' WHERE id = :id', [$id], true);
    }

    /**
     * Supprime un enregistrement de la table
     *
     * @param int $id
     * @return boolean
     */
    public function destroy($id): bool
    {
        // $sql = 'DELETE FROM ' . $this->table . ' WHERE id = :id';
        // $stmt = $this->db->getPDO()->prepare($sql);
        // $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
        // return $stmt->execute();
        return $this->query('DELETE FROM ' . $this->table . ' WHERE id = :id', [$id]);
    }

    /**
     * Met à jour un enregistrement de la table
     *
     * @param int $id
     * @param array $data
     * @return boolean
     */
    public function update($id, $data): bool
    {
        // $sql = 'UPDATE ' . $this->table . ' SET ';
        // foreach ($data as $key => $value) {
        //     $sql .= $key . ' = :' . $key . ', ';
        // }
        // $sql = substr($sql, 0, -2);
        // $sql .= ' WHERE id = :id';
        // $stmt = $this->db->getPDO()->prepare($sql);
        // foreach ($data as $key => $value) {
        //     $stmt->bindValue(':' . $key, $value);
        // }
        // $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
        // return $stmt->execute();

        $sqlRequestPart = "";
        $i = 1;
        foreach ($data as $key => $value) {
            $comma = $i === count($data) ? '' : ', ';
            $sqlRequestPart .= $key . ' = :' . $key . $comma;
            $i++;
        }
        $data['id'] = $id;

        return $this->query('UPDATE ' . $this->table . ' SET ' . $sqlRequestPart . ' WHERE id = :id', $data);
    }

    /**
     * Execute une requete SQL
     *
     * @param string $sql
     * @param array $param
     * @param boolean|null $single
     * @return boolean|array
     */
    public function query(string $sql, array $param, bool $single = null)
    {
        $method = is_null($param) ? 'query' : 'prepare';

        if(strpos($sql, 'DELETE') === 0 
        || strpos($sql, 'UPDATE') === 0
        || strpos($sql, 'INSERT') === 0
        || strpos($sql, 'CREATE') === 0
        || strpos($sql, 'REPLACE') === 0
        ) {
            $stmt = $this->db->getPDO()->$method($sql);
            $stmt->setFetchMode(\PDO::FETCH_CLASS, get_class($this), [$this->db]);
            return $stmt->execute();
        }

        $fetch = is_null($single) ? 'fetchAll' : 'fetch';
        $stmt = $this->db->getPDO()->$method($sql);
        $stmt->setFetchMode(\PDO::FETCH_CLASS, get_class($this), [$this->db]);

        if($method ==='query') {
            return $stmt->$fetch();
        } else {
            $stmt->execute($param);
            return $stmt->$fetch();
        }
    }
}
