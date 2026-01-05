<?php
require_once $_ENV['BONUS_PATH']."app/model/bddModel.php";

function getAllTemoignages() {
    $sql = "SELECT * FROM TEMOIGNAGE";
    return get($sql);
}