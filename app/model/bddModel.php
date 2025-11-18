<?php

function getDatabase(){

    $db_name = 'ecogestum';
    $conn = connectToDatabase();
    $stmt = $conn->query("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '$db_name'");
    if ($stmt->rowCount() == 0) {
        return setup_database();
    }
    return connectToDatabase();
}
function setup_database(){
    createDatabase();
    insertData();
    return connectToDatabase();
}
function connectToDatabase(){
    $hostname = 'localhost';
    $username = 'root';
    $password = '';
    $conn = new PDO("mysql:host=$hostname;dbname=ecogestum", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $conn;
}

function executionSQL($sqlFile){
    $conn = connectToDatabase();
    $sql = file_get_contents($sqlFile);
    if ($sql === false){
        die("Erreur lors de la lecture du fichier SQL");
    }
    $conn->exec($sql);
}
function createDatabase(){
    $sqlFile = __DIR__ . '/assets/sql/script_creation.sql';
    executionSQL($sqlFile);
}

function insertData(){
    $sqlFile = __DIR__ . '/assets/sql/script_insertion.sql';
    executionSQL($sqlFile);
}