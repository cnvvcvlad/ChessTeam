<?php

namespace Democvidev\ChessTeam\Database;

class DataBaseConnection
{
    private $host;
    private $username;
    private $password;
    private $database;
    private static $instancePDO = null;

    public function __construct()
    {
        $this->host = DB_HOST;
        $this->username = DB_USER;
        $this->password = DB_PASSWORD;
        $this->database = DB_NAME;
    }

    /**
     * La fonction établie la connexion avec une base de données
     *
     * @return PDO
     */
    public function getPDO(): \PDO
    {
        // pattern singleton, retourne toujours une seule instance pdo
        if (self::$instancePDO === null) {
            try {
                $pdo = new \PDO(
                    'mysql:host=' . $this->host . ';dbname=' . $this->database,
                    $this->username,
                    $this->password,
                    [
                        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                        \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
                    ]
                );
                $pdo->exec('SET NAMES UTF8');
                self::$instancePDO = $pdo;
                // return $pdo;
            } catch (\Exception $e) {
                die('Erreur : ' . $e->getMessage()) or
                    die(print_r($pdo->errorInfo()));
            }
        }
        return self::$instancePDO;
    }
}
