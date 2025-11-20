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