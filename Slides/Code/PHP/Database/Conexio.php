<?php 
class Conexio {
    private $connexion;

    public function __construct() {
        $configuracion = require('config.php');
        $host = $configuracion['host'];
        $database = $configuracion['dbname'];
        $user = $configuracion['usr'];
        $password = $configuracion['pwd'];

        try {
            $this->connexion = new PDO("mysql:host=$host;dbname=$database", $user, $password);
            $this->connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $ex) {
            echo 'Error de conexión';
        }
    }

    public function getConnection() {
        return $this->connexion;
    }

}

