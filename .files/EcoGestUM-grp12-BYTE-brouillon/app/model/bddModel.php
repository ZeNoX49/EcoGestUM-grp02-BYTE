<?php

function getDatabase(){
    $db_name = 'ecogestum';
    $conn = connectToDatabase();
    $stmt = $conn->query("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '$db_name'");
    if ($stmt->rowCount() == 0) {
        setup_database();
    }
    return connectToDatabase();
}
function setup_database(){
    $conn = connectToDatabase();
    createDatabase($conn);
    insertData($conn);
    setProcedure($conn);
}
function connectToDatabase(){
    $hostname = 'localhost';
    $username = 'root';
    $password = '';
    $conn = new PDO("mysql:host=$hostname;dbname=ecogestum", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $conn;
}

function executionSQL($sqlFile, $conn = null){
    $sql = file_get_contents($sqlFile);
    if ($sql === false){
        die("Erreur lors de la lecture du fichier SQL");
    }
    $conn->exec($sql);
}
function createDatabase($conn){
    $sqlFile = __DIR__ . '/assets/sql/script_creation.sql';
    executionSQL($sqlFile, $conn);
}

function insertData($conn ){
    $sqlFile = __DIR__ . '/assets/sql/script_insertion.sql';
    executionSQL($sqlFile, $conn);
}

function setProcedure($conn){
    $sqlFileEnseignant = __DIR__ . '/assets/sql/script_enseignant.sql';
    $sqlFileEtudiant = __DIR__ . '/assets/sql/script_etudiant.sql';
    $sqlFilePresidence = __DIR__ . '/assets/sql/script_presidence.sql';
    executionSQL($sqlFileEnseignant, $conn);
    executionSQL($sqlFileEtudiant, $conn);
    executionSQL($sqlFilePresidence, $conn);
}