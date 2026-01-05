<?php
require_once $_ENV['BONUS_PATH']."app/model/bddModel.php";

function getAllCategories() {
    $sql = "SELECT * FROM CATEGORIE ORDER BY nom_categorie ASC";
    return get($sql);
}

function insertCategory($nom, $description, $icone, $statut) {
    $sql = "INSERT INTO CATEGORIE (nom_categorie, description_categorie, image_categorie, statut_categorie) VALUES (?, ?, ?, ?)";
    $params = [$nom, $description, $icone, $statut];
    return insert($sql, $params);
}

function updateCategory($id, $nom, $description, $icone, $statut) {
    $sql = "UPDATE CATEGORIE SET nom_categorie = ?, description_categorie = ?, image_categorie = ?, statut_categorie = ? WHERE id_categorie = ?";
    $params = [$nom, $description, $icone, $statut, $id];
    return update($sql, $params);
}

function deleteCategory($id) {
    $sql = "DELETE FROM CATEGORIE WHERE id_categorie = ?";
    $params = [$id];
    return delete($sql, $params);
}

function countObjetsParCategorie($id_cat) {
    $sql = "SELECT COUNT(*) FROM OBJET WHERE id_categorie = ?";
    $params = [$id_cat];
    return getCount($sql, $params);
}