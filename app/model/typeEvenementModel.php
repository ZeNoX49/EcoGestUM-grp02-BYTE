<?php
require_once "app/model/bddModel.php";

function getAllEventType() {
    $bdd = get_bdd();
    $req = $bdd->query("SELECT * FROM TYPEEVENEMENT");
    return $req->fetchAll(PDO::FETCH_ASSOC);
}