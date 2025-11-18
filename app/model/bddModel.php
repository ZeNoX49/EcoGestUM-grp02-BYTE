<?php
function createDatabase(){
    $hostname = "localhost";
    $dbname = "ecogestum";
    $username = "root";
    $password = "";
    $sqlFile = __DIR__ . '/assets/sql/script_creation.sql';

    try {
        $pdo = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = file_get_contents($sqlFile);
        if ($sql === false){
            die("Erreur lors de la lecture du fichier SQL");
        }
        $pdo->exec($sql);
    } catch (PDOException $e) {
        die('Erreur PDO : ' . $e->getMessage());
    }
}

