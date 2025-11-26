<?php
require_once $_ENV['BONUS_PATH']."app/model/bddModel.php";

function getAllCategories() {
    $bdd = get_bdd();
    $req = $bdd->query("SELECT * FROM CATEGORIE ORDER BY nom_categorie ASC");
    return $req->fetchAll(PDO::FETCH_ASSOC);
}

function insertCategory($nom, $description, $icone, $statut) {
    $bdd = get_bdd();
    $stmt = $bdd->prepare("INSERT INTO CATEGORIE (nom_categorie, description_categorie, image_categorie, statut_categorie) VALUES (:nom, :desc, :img, :statut)");
    return $stmt->execute([
        ':nom' => $nom,
        ':desc' => $description,
        ':img' => $icone,
        ':statut' => $statut
    ]);
}

function updateCategory($id, $nom, $description, $icone, $statut) {
    $bdd = get_bdd();
    $stmt = $bdd->prepare("UPDATE CATEGORIE SET nom_categorie = :nom, description_categorie = :desc, image_categorie = :img, statut_categorie = :statut WHERE id_categorie = :id");
    return $stmt->execute([
        ':id' => $id,
        ':nom' => $nom,
        ':desc' => $description,
        ':img' => $icone,
        ':statut' => $statut
    ]);
}

function deleteCategory($id) {
    $bdd = get_bdd();
    $stmt = $bdd->prepare("DELETE FROM CATEGORIE WHERE id_categorie = :id");
    return $stmt->execute([':id' => $id]);
}

function countObjetsParCategorie($id_cat) {
    $bdd = get_bdd();
    $stmt = $bdd->prepare("SELECT COUNT(*) FROM OBJET WHERE id_categorie = :id");
    $stmt->execute([':id' => $id_cat]);
    return $stmt->fetchColumn();
}