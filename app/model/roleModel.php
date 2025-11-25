<?php
require_once $_ENV['BONUS_PATH']."app/model/bddModel.php";

function getAllRoles() {
    $bdd = get_bdd();
    $req = $bdd->query("SELECT * FROM ROLE");
    return $req->fetchAll(PDO::FETCH_ASSOC);
}