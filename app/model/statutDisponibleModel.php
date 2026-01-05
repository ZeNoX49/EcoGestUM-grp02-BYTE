<?php
require_once $_ENV['BONUS_PATH']."app/model/bddModel.php";
function getAllStatutDisponible(){
    $sql = "SELECT * FROM sae.STATUTDISPONIBLE ORDER BY nom_statut_disponibilite ASC";
    return get($sql);
}