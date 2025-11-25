<?php
require_once "app/model/bddModel.php";

function getAllDepSer() {
    $bdd = get_bdd();
    $req = $bdd->query("SELECT * FROM DEPSER");
    return $req->fetchAll(PDO::FETCH_ASSOC);
}