<?php

function get_bdd(){
    $db_name = 'ECOGESTUM';
    $hostname = 'localhost';
    $user = 'root';
    $password = '';

    $dsn = "mysql:host=$hostname;dbname=$db_name;charset=utf8mb4";
    $pdo = new PDO($dsn, $user, $password);

    return $pdo;
}

function create_database(){
    function execute($sqlFile){
        $bdd = get_bdd();
        if ($sql = file_get_contents($sqlFile) === false) {
            echo "Erreur lors de la lecture du fichier SQL : " . $sqlFile;
            return false;
        }
        return $bdd->exec($sql);
    }

    if(!execute(__DIR__ . '/assets/sql/script_creation.sql')) return;
    if(!execute(__DIR__ . '/assets/sql/script_insertion.sql')) return;
    execute(__DIR__ . '/assets/sql/script_enseignant.sql');
    execute(__DIR__ . '/assets/sql/script_etudiant.sql');
    execute(__DIR__ . '/assets/sql/script_presidence.sql');
}