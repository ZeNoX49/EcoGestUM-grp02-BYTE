<?php
require_once $_ENV['BONUS_PATH']."app/model/bddModel.php";

function getAllStatutDisponible(){
    $sql = "SELECT * FROM STATUTDISPONIBLE";
    return get($sql);
}