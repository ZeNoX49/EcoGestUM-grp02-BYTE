<?php
require_once $_ENV['BONUS_PATH']."app/model/bddModel.php";

function getReservationsByUser($idUser) {
    $sql = "SELECT r.*, 
                   o.nom_objet, o.description_objet, o.image_objet, 
                   c.nom_categorie, 
                   s.nom_statut_reservation, 
                   pc.nom_point_collecte, pc.adresse_point_collecte,
                   u_prop.email_utilisateur as email_proprietaire,
                   u_prop.nom_utilisateur as nom_proprietaire
            FROM RESERVER r
            JOIN OBJET o ON r.id_objet = o.id_objet
            JOIN CATEGORIE c ON o.id_categorie = c.id_categorie
            JOIN STATUTRESERVATION s ON r.id_statut_reservation = s.id_statut_reservation
            LEFT JOIN POINTCOLLECTE pc ON o.id_point_collecte = pc.id_point_collecte
            JOIN UTILISATEUR u_prop ON o.id_utilisateur = u_prop.id_utilisateur
            WHERE r.id_utilisateur = ?
            ORDER BY r.date_reservation DESC";
    $params = [$idUser];
    return get($sql, $params);
}

function createReservation($idUser, $idObjet) {
    $sql = "INSERT INTO RESERVER (id_objet, date_reservation, id_utilisateur, id_statut_reservation) VALUES (?, NOW(), ?, 1)";
    $params = [$idObjet, $idUser];
    if(!insert($sql, $params)) return false;

    $sql = "UPDATE OBJET SET id_statut_disponibilite = 2 WHERE id_objet = ?";
    $params = [$idObjet];
    return update($sql, $params);
}

function cancelReservation($idUser, $idObjet) {
    $sql = "DELETE FROM RESERVER WHERE id_utilisateur = ? AND id_objet = ?";
    $params = [$idUser, $idObjet];
    if(!delete($sql, $params)) return false;

    $sql = "UPDATE OBJET SET id_statut_disponibilite = 1 WHERE id_objet = ?";
    $params = [$idObjet];
    return update($sql, $params);
}

function confirmReception($idUser, $idObjet) {
    $sql = "UPDATE RESERVER SET id_statut_reservation = 4 WHERE id_utilisateur = ? AND id_objet = ?";
    $params = [$idUser, $idObjet];
    return get($sql, $params);
}

function getReservationsByStatutDisp($idStatut){
    $sql = "SELECT * FROM OBJET WHERE id_statut_disponibilite = ?";
    $params = [$idStatut];
    return get($sql, $params);
}