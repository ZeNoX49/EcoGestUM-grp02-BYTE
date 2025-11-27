<?php
require_once $_ENV['BONUS_PATH']."app/model/bddModel.php";

function getObjetsDisponibles() {
    if (isset($_GET['id'])) {
        $sql = "SELECT * FROM objets_disponibles WHERE id_objet = ?";
        $params = [$_GET['id']];
        return get($sql ,$params);
    } else {
        $sql = "SELECT * FROM objets_disponibles";
        return get($sql);
    }
}

