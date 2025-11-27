<?php
require_once $_ENV['BONUS_PATH']."app/model/bddModel.php";

function getAllRoles() {
    $sql = "SELECT * FROM ROLE";
    return get($sql);
}