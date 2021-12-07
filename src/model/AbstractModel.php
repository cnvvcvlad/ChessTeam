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

    /**
     * Récupère toutes les donées de la table
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
}
