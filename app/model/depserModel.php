<?php
require_once $_ENV['BONUS_PATH']."app/model/bddModel.php";

function getAllDepSer() {
    $sql = "SELECT * FROM DEPSER";
    return get($sql);
}