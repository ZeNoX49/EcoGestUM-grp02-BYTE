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
    $query = $bdd->query("SELECT * FROM OBJET WHERE id_objet = '$id_object'");
    $object = $query->fetchAll(PDO::FETCH_ASSOC);
    return $object;
}

function getObjectDisponible() {
    $bdd = get_bdd();
    $query = $bdd->query("SELECT * FROM objets_disponibles");
    $objects = $query->fetchAll(PDO::FETCH_ASSOC);
    return $objects;
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