<?php

require_once $_ENV['BONUS_PATH']."app/model/bddModel.php";
function getAllStatutDisponible() {
    $bdd = get_bdd();
    $req = $bdd->query("SELECT * FROM STATUTDISPONIBLE");
    return $req->fetchAll(PDO::FETCH_ASSOC);
}