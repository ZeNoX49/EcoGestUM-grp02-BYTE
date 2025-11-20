<?php

require "bddModel.php";

function insert_object($image, $name, $description, $date, $id_collect_point, $id_trade_type, $id_user, $id_etat, $id_category) {
    $bdd = get_bdd();

    $stmt = $bdd->prepare("INSERT INTO OBJET (image_objet, nom_objet, description_objet, date_ajout_objet, id_point_collecte, id_type_echange, id_utilisateur, id_statut_disponibilite, id_etat, id_categorie) 
                          VALUES (':image_objet', ':nom_objet', ':description_objet', ':date_ajout_objet', :id_point_collecte, :id_type_echange, :id_utilisateur, 0, :id_etat, :id_categorie)");


    return $stmt->execute([
        ':image_objet' => $image,
        ':nom_objet' => $name,
        ':description_objet' => $description,
        ':date_ajout_objet' => $date,
        ':id_point_collecte' => $id_collect_point,
        ':id_type_echange' => $id_trade_type,
        ':id_utilisateur' => $id_user,
        ':id_etat' => $id_etat,
        ':id_categorie' => $id_category
    ]);
}

function getObject($id_object) {
    $bdd = get_bdd();
    $sql = "SELECT * FROM objet o
        JOIN CATEGORIE c ON c.id_categorie = o.id_categorie 
        JOIN ETAT e ON e.id_etat = o.id_etat
        JOIN POINTCOLLECTE p ON p.id_point_collecte = o.id_point_collecte
        JOIN UTILISATEUR u ON u.id_utilisateur = o.id_utilisateur

         WHERE id_objet = ?";
    $stmt = $bdd->prepare($sql);
    $stmt->execute([$id_object]);
    return $stmt->fetch();
}

function getObjectDisponible() {
    $bdd = get_bdd();
    $query = $bdd->query("SELECT * FROM objets_disponibles");
    $objects = $query->fetchAll(PDO::FETCH_ASSOC);
    return $objects;
}

function getFilteredObjects($search = '', $catId = null, $etatNom = null, $location = '') {
    $bdd = get_bdd();
    $sql = "SELECT * FROM objets_disponibles WHERE 1=1";
    $params = [];
    // Filtre Recherche
    if (!empty($search)) {
        $sql .= " AND (nom_objet LIKE :search OR description_objet LIKE :search)";
        $params[':search'] = "%$search%";
    }
    // Filtre Catégorie
    if (!empty($catId)) {
        $sql .= " AND id_categorie = :cat";
        $params[':cat'] = $catId;
    }
    // Filtre État
    if (!empty($etatNom)) {
        $sql .= " AND nom_etat = :etat";
        $params[':etat'] = $etatNom;
    }
    // Filtre Localisation
    if (!empty($location)) {
        $sql .= " AND (nom_point_collecte LIKE :loc OR adresse_point_collecte LIKE :loc)";
        $params[':loc'] = "%$location%";
    }

    $stmt = $bdd->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getAllCategories() {
    $bdd = get_bdd();
    $req = $bdd->query("SELECT * FROM CATEGORIE ORDER BY nom_categorie");
    return $req->fetchAll(PDO::FETCH_ASSOC);
}

function getAllEtats() {
    $bdd = get_bdd();
    $req = $bdd->query("SELECT * FROM ETAT");
    return $req->fetchAll(PDO::FETCH_ASSOC);
}

function getAllLocations() {
    $bdd = get_bdd();
    $req = $bdd->query("SELECT * FROM POINTCOLLECTE ORDER BY nom_point_collecte");
    return $req->fetchAll(PDO::FETCH_ASSOC);
}

// function getNbObjPropUser($id_user) {
//     $bdd = get_bdd();
//     $query = $bdd->query("SELECT COUNT(*) FROM mes_objets_donnes $id_user");
//     $objects = $query->fetchAll(PDO::FETCH_ASSOC);
//     return $objects;
// }

// function getNbObjRecupUser($id_user) {
//     $bdd = get_bdd();
//     $query = $bdd->query("SELECT COUNT(*) FROM reservations_recues $id_user");
//     $objects = $query->fetchAll(PDO::FETCH_ASSOC);
//     return $objects;
// }