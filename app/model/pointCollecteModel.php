<?php
require_once "app/model/bddModel.php";

function getAllPointCollecte() {
    $bdd = get_bdd();
    $req = $bdd->query("SELECT * FROM POINTCOLLECTE");
    return $req->fetchAll(PDO::FETCH_ASSOC);
} 