<?php
require_once "bddModel.php";

function insertChoixNotification($id_utilisateur, $categorie_choix, $type_choix, $id_choix) {
    $bdd = get_bdd();
    $stmt = $bdd->prepare(
        "INSERT INTO CHOIXNOTIFICATION (id_utilisateur, categorie_choix, type_choix, id_choix) 
        VALUES (:id_utilisateur, ':categorie_choix', ':type_choix', :id_choix)"
    );
    return $stmt->execute([
        ':id_utilisateur' => $id_utilisateur,
        ':categorie_choix' => $categorie_choix,
        ':type_choix' => $type_choix,
        ':id_choix' => $id_choix
    ]);
}

function deleteChoixNotification($id_utilisateur, $categorie_choix, $type_choix, $id_choix) {
    $bdd = get_bdd();
    $stmt = $bdd->prepare(
        "DELETE FROM CHOIXNOTIFICATION WHERE 
        id_utilisateur = :id_utilisateur,
        categorie_choix = ':categorie_choix',
        type_choix = ':type_choix',
        id_choix = :id_choix"
    );
    return $stmt->execute([
        ':id_utilisateur' => $id_utilisateur,
        ':categorie_choix' => $categorie_choix,
        ':type_choix' => $type_choix,
        ':id_choix' => $id_choix
    ]);
}

function getChoixNotification($id_utilisateur, $categorie_choix, $type_choix) {
    $bdd = get_bdd();
    $req = $bdd->query(
        "SELECT * FROM CHOIXNOTIFICATION WHERE
        id_utilisateur = $id_utilisateur AND
        categorie_choix = '$categorie_choix' AND
        type_choix = '$type_choix'"
    );
    return $req->fetchAll(PDO::FETCH_ASSOC);
}