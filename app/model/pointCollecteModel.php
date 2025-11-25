<?php
require_once $_ENV['BONUS_PATH']."app/model/bddModel.php";

function getAllPointCollecte() {
    $bdd = get_bdd();
    $req = $bdd->query("SELECT * FROM POINTCOLLECTE");
    return $req->fetchAll(PDO::FETCH_ASSOC);
} 