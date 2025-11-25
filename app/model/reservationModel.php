<?php
require_once $_ENV['BONUS_PATH']."app/model/bddModel.php";

function getReservationsByUser($idUser) {
    $bdd = get_bdd();
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

    $stmt = $bdd->prepare($sql);
    $stmt->execute([$idUser]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function createReservation($idUser, $idObjet) {
    $bdd = get_bdd();
    try {
        $bdd->beginTransaction();

        $stmt = $bdd->prepare("INSERT INTO RESERVER (id_objet, date_reservation, id_utilisateur, id_statut_reservation) VALUES (?, NOW(), ?, 1)");
        $stmt->execute([$idObjet, $idUser]);

        $stmtObj = $bdd->prepare("UPDATE OBJET SET id_statut_disponibilite = 2 WHERE id_objet = ?");
        $stmtObj->execute([$idObjet]);

        $bdd->commit();
        return true;
    } catch(Exception $e) {
        $bdd->rollBack();
        return false;
    }
}
function cancelReservation($idUser, $idObjet) {
    $bdd = get_bdd();
    try {
        $bdd->beginTransaction();

        $stmt = $bdd->prepare("DELETE FROM RESERVER WHERE id_utilisateur = ? AND id_objet = ?");
        $stmt->execute([$idUser, $idObjet]);

        $stmtObj = $bdd->prepare("UPDATE OBJET SET id_statut_disponibilite = 1 WHERE id_objet = ?");
        $stmtObj->execute([$idObjet]);

        $bdd->commit();
    } catch(Exception $e) {
        $bdd->rollBack();
    }
}

function confirmReception($idUser, $idObjet) {
    $bdd = get_bdd();
    $stmt = $bdd->prepare("UPDATE RESERVER SET id_statut_reservation = 4 WHERE id_utilisateur = ? AND id_objet = ?");
    return $stmt->execute([$idUser, $idObjet]);
}



function getReservationsByStatutDisp($idStatut){
    $bdd = get_bdd();
    $sql = "SELECT * FROM OBJET WHERE id_statut_disponibilite = ?";
    $stmt = $bdd->prepare($sql);
    $stmt->execute([$idStatut]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}