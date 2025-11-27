<?php
require_once $_ENV['BONUS_PATH']."app/model/bddModel.php";

function insertChoixNotification($id_utilisateur, $categorie_choix, $type_choix, $id_choix) {
    $sql = "INSERT INTO CHOIXNOTIFICATION (id_utilisateur, categorie_choix, type_choix, id_choix) VALUES (?, '?', '?', ?)";
    $params = [$id_utilisateur, $categorie_choix, $type_choix, $id_choix];
    return insert($sql, $params);
}

function deleteChoixNotification($id_utilisateur, $categorie_choix, $type_choix, $id_choix) {
    $sql = "DELETE FROM CHOIXNOTIFICATION WHERE id_utilisateur = ? AND categorie_choix = '?' AND type_choix = '?' AND id_choix = ?";
    $params = [$id_utilisateur, $categorie_choix, $type_choix, $id_choix];
    return delete($sql, $params);
}

function getChoixNotification($id_utilisateur, $categorie_choix, $type_choix) {
    $sql = "SELECT * FROM CHOIXNOTIFICATION WHERE id_utilisateur = ? AND categorie_choix = '?' AND type_choix = '?'";
    $params = [$id_utilisateur, $categorie_choix, $type_choix];
    return get($sql, $params);
}