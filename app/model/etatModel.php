<?php
require_once $_ENV['BONUS_PATH']."app/model/bddModel.php";

function getAllEtats() {
    $sql = "SELECT * FROM ETAT";
    return get($sql);
}