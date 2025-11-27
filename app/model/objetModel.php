<?php

require_once $_ENV['BONUS_PATH']."app/model/bddModel.php";

function insert_object($image, $name, $description, $date, $id_collect_point, $id_trade_type, $id_user, $id_etat, $id_category, $quantite) {
    $sql = "INSERT INTO OBJET (image_objet, nom_objet, description_objet, date_ajout_objet, id_point_collecte, id_type_echange, id_utilisateur, id_statut_disponibilite, id_etat, id_categorie, quantite) 
            VALUES (?, ?, ?, ?, ?, ?, ?, 3, ?, ?, ?)";
    $params = [$image, $name, $description, $date, $id_collect_point, $id_trade_type, $id_user, $id_etat, $id_category, $quantite];
    return insert($sql, $params);
}

function getObject($id_object) {
    $sql = "SELECT * FROM OBJET o
            JOIN CATEGORIE c ON c.id_categorie = o.id_categorie 
            JOIN ETAT e ON e.id_etat = o.id_etat
            JOIN POINTCOLLECTE p ON p.id_point_collecte = o.id_point_collecte
            JOIN UTILISATEUR u ON u.id_utilisateur = o.id_utilisateur
            WHERE id_objet = ?";
    $params = [$id_object];
    return get($sql, $params);
}

function getFilteredObjects($search = '', $catId = null, $etatNom = null, $location = '') {
    $sql = "SELECT * FROM objets_disponibles WHERE 1=1";
    $params = [];
    if (!empty($search)) {
        $sql .= " AND (nom_objet LIKE :search OR description_objet LIKE :search)";
        $params[':search'] = "%$search%";
    }
    if (!empty($catId)) {
        $sql .= " AND id_categorie = :cat";
        $params[':cat'] = $catId;
    }
    if (!empty($etatNom)) {
        $sql .= " AND nom_etat = :etat";
        $params[':etat'] = $etatNom;
    }
    if (!empty($location)) {
        $sql .= " AND (nom_point_collecte LIKE :loc OR adresse_point_collecte LIKE :loc)";
        $params[':loc'] = "%$location%";
    }
    return get($sql, $params);
}

function getObjectUtilisateur($id_utilisateur) {
    $sql = "SELECT * FROM OBJET o
            JOIN CATEGORIE c ON c.id_categorie = o.id_categorie
            JOIN ETAT e ON e.id_etat = o.id_etat
            JOIN POINTCOLLECTE p ON p.id_point_collecte = o.id_point_collecte
            JOIN STATUTDISPONIBLE s ON s.id_statut_disponibilite = o.id_statut_disponibilite
            WHERE o.id_utilisateur = ?";
    $params = [$id_utilisateur];
    return get($sql, $params);
}

function getAllObject(){
    $sql = "SELECT * FROM OBJET o
            JOIN CATEGORIE c ON c.id_categorie = o.id_categorie
            JOIN ETAT e ON e.id_etat = o.id_etat
            JOIN POINTCOLLECTE p ON p.id_point_collecte = o.id_point_collecte
            JOIN STATUTDISPONIBLE s ON s.id_statut_disponibilite = o.id_statut_disponibilite
            JOIN UTILISATEUR u ON u.id_utilisateur = o.id_utilisateur";
    return get($sql);
}

function countObjectStatus($objets, $id_status) {
    $count = 0;
    if (is_array($objets)) {
        foreach($objets as $objet) {
            if(isset($objet['id_statut_disponibilite']) && $objet['id_statut_disponibilite'] == $id_status) {
                $count++;
            }
        }
    }
    return $count;
}

function deleteObject($id_objet){
    $sql = "DELETE FROM OBJET WHERE id_objet = ?";
    $params = [$id_objet];
    return delete($sql, $params);
}

function updateObject($id, $nom, $desc, $idPoint, $idEtat, $idCat, $quantite, $image) {
    $sql = "UPDATE OBJET SET 
            nom_objet = ?, 
            description_objet = ?, 
            id_point_collecte = ?, 
            id_etat = ?, 
            id_categorie = ?, 
            quantite = ?,
            image_objet = ?
            WHERE id_objet = ?";
    $params = [$nom, $desc, $idPoint, $idEtat, $idCat, $quantite, $image, $id];
    return update($sql, $params);
}

// function getNbObjPropUser($id_user) {
//     $sql = "SELECT COUNT(*) FROM mes_objets_donnes ?";
//     $params = [$id_user];
//     return get($sql, $params);
// }

// function getNbObjRecupUser($id_user) {
//     $sql = "SELECT COUNT(*) FROM reservations_recues ?";
//     $params = [$id_user];
//     return get($sql, $params);
// }