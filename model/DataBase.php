<?php

class DataBase {
    private $host = 'localhost';
    private $username = 'root';
    private $password = 'laromaclub2008';
    private $database = 'team_chess';
    private $pdo;

    public function __construct($host=null, $username=null, $password=null, $database=null) {
        if($host != null) {
            $this->host = $host;
            $this->username = $username;
            $this->password = $password;
            $this->database = $database;
        }
    }

    public function dbConnect() {

        try {
            $this->pdo = new \PDO
            ('mysql:host=' . $this->host . ';dbname=' . $this->database, $this->username, $this->password, [
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
                ]);
                $this->pdo->exec("SET NAMES UTF8");
                
                return $this->pdo;
            }
            catch (\Exception $e) {
                die('Erreur : ' . $e->getMessage()) or die(print_r($this->pdo->errorInfo()));
            }
    }

}