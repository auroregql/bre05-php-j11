<?php

abstract class AbstractManager {
    protected PDO $db;

    public function __construct() {
        $host = "db.3wa.io";
        $dbname = "auroregicquelcolleu_phpj11";
        $username = "auroregicquelcolleu";
        $password = "514b3eda307289da5b9ccb0a4735bcd4";
        $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8";

        try {
            $this->db = new PDO($dsn, $username, $password);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erreur de connexion à la base : " . $e->getMessage());
        }
    }
}

?>