<?php

function get_bdd(){
    $db_name = 'sae';
    $hostname = 'localhost';
    $user = 'etu';
    $password = 'Achanger!';

    $dsn = "mysql:host=$hostname;dbname=$db_name;charset=utf8mb4";
    $pdo = new PDO($dsn, $user, $password);

    return $pdo;
}