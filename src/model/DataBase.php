<?php

namespace Democvidev\ChessTeam\Model;

class DataBase
{
    private $host = 'localhost';
    private $username = 'root';
    private $password = '';
    private $database = 'team_chess';
    private static $instancePDO = null;

    public function __construct(
        $host = null,
        $username = null,
        $password = null,
        $database = null
    ) {
        if ($host != null) {
            $this->host = $host;
            $this->username = $username;
            $this->password = $password;
            $this->database = $database;
        }
    }

    /**
     * La fonction établie la connexion avec une base de données
     *
     * @return PDO
     */
    public function dbConnect(): \PDO
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
                return $pdo;
            } catch (\Exception $e) {
                die('Erreur : ' . $e->getMessage()) or
                    die(print_r($pdo->errorInfo()));
            }
        }
        return self::$instancePDO;
    }
}
