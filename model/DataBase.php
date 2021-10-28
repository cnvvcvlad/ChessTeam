<?php

/**
 * Cette classe n'aura jamais besoin d'être instanciée plusieurs fois
 */
class DataBase
{
    private $host = 'localhost';
    private $username = 'root';
    private $password = '';
    private $database = 'team_chess';
    // pattern singleton, retourne toujours une seule instance pdo
    private static $instancePDO = null;

    public function __construct(
        $host = null,
        $username = null,
        $password = null,
        $database = null
    ) {
        // une fois la connexion établie avec le serveur
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
    public function dbConnect()
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
