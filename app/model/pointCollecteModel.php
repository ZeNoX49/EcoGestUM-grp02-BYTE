<?php
require_once $_ENV['BONUS_PATH']."app/model/bddModel.php";

function getAllPointCollecte() {
    $sql = "SELECT * FROM POINTCOLLECTE ORDER BY nom_point_collecte";
    return get($sql);
}

function getPointCollecteById($id) {
    $sql = "SELECT * FROM POINTCOLLECTE WHERE id_point_collecte = ?";
    return get($sql, [$id]);
}

function getIdPointCollecteByName($nom) {
    $sql = "SELECT id_point_collecte FROM POINTCOLLECTE WHERE nom_point_collecte LIKE ?";
    $params = [$nom];
    return get($sql, $params);
}

function createPointCollecte($nom) {
    $sql = "INSERT INTO POINTCOLLECTE (nom_point_collecte, adresse_point_collecte) VALUES (?, ?)";
    $params = [$nom, "Adresse non spécifiée"];
    return insert($sql, $params);
}

// pas fameux comme fonction, si quelqu'un ajoute un autre objet en même temps ca foire 
function getLastIdPointCollecte() {
    $sql = "SELECT MAX(id_point_collecte) as max_id_pc FROM POINTCOLLECTE";
    return get($sql)[0]["max_id_pc"];
}