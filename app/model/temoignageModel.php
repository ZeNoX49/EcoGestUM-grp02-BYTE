<?php
require_once "app/model/bddModel.php";

function getAllTemoignages() {
    $bdd = get_bdd();
    $query = $bdd->query('SELECT * FROM TEMOIGNAGE');
    $users = $query->fetchAll(PDO::FETCH_ASSOC);
    return $users;
}