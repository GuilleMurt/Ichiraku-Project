<?php
require_once 'credencials.php';

class db {
    public static function connect() {
        global $pdo;

        try {
            $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
            // echo "Conexión establecida";
        } catch (PDOException $e) {
            echo "Error en la conexión: " . $e->getMessage();
        }
        
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->exec('SET NAMES "utf8"');

        return $pdo;
    }
}
?>