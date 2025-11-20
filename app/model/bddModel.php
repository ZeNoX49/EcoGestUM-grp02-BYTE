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

function setHashedPassword(){
    $bdd = get_bdd();
    $query = $bdd->query("SELECT COUNT(*) FROM UTILISATEUR");
    $nb = $query->fetchColumn();
    for($i=1;$i<=$nb;$i++){
        $query = $bdd->query("SELECT mdp_utilisateur FROM UTILISATEUR WHERE id_utilisateur = $i");
        $user = $query->fetchAll(PDO::FETCH_ASSOC);
        $hashedPassword = password_hash($user[0]['mdp_utilisateur'], PASSWORD_DEFAULT);
        $query = $bdd->query("UPDATE UTILISATEUR SET mdp_utilisateur = '$hashedPassword' WHERE id_utilisateur = $i");
        $query->fetchAll();
    }
}