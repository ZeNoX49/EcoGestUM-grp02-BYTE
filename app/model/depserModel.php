<?php
require_once $_ENV['BONUS_PATH']."app/model/bddModel.php";

function getAllDepSer() {
    $bdd = get_bdd();
    $req = $bdd->query("SELECT * FROM DEPSER");
    return $req->fetchAll(PDO::FETCH_ASSOC);
}