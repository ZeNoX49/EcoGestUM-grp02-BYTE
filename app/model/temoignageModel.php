<?php
require_once $_ENV['BONUS_PATH']."app/model/bddModel.php";

function getAllTemoignages() {
    $bdd = get_bdd();
    $query = $bdd->query('SELECT * FROM TEMOIGNAGE');
    $users = $query->fetchAll(PDO::FETCH_ASSOC);
    return $users;
}