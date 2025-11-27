<?php
require_once $_ENV['BONUS_PATH']."app/model/bddModel.php";

function getAllEventType() {
    $sql = "SELECT * FROM TYPEEVENEMENT";
    return get($sql);
}