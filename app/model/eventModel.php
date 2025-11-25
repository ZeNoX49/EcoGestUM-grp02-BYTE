<?php

require_once "bddModel.php";

/**
 * Récupère tous les événements
 */
function getAllEvents() {
    $bdd = get_bdd();
    $sql = "SELECT e.*, u.nom_utilisateur, u.prenom_utilisateur, t.nom_type_evenement
            FROM EVENEMENT e
            LEFT JOIN UTILISATEUR u ON u.id_utilisateur = e.id_utilisateur
            LEFT JOIN TYPEEVENEMENT t ON t.id_type_evenement = e.id_type_evenement
            ORDER BY e.date_debut_evenement DESC";
    $stmt = $bdd->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Récupère un événement par son ID
 */
function getEventById($id) {
    $bdd = get_bdd();
    $sql = "SELECT e.*, u.nom_utilisateur, u.prenom_utilisateur, t.nom_type_evenement
            FROM EVENEMENT e
            LEFT JOIN UTILISATEUR u ON u.id_utilisateur = e.id_utilisateur
            LEFT JOIN TYPEEVENEMENT t ON t.id_type_evenement = e.id_type_evenement
            WHERE e.id_evenement = ?";
    $stmt = $bdd->prepare($sql);
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function getUpcomingEvents() {
    $bdd = get_bdd();
    $sql = "SELECT e.*, u.nom_utilisateur, u.prenom_utilisateur, t.nom_type_evenement
            FROM EVENEMENT e
            LEFT JOIN UTILISATEUR u ON u.id_utilisateur = e.id_utilisateur
            LEFT JOIN TYPEEVENEMENT t ON t.id_type_evenement = e.id_type_evenement
            WHERE e.date_debut_evenement > NOW()
            ORDER BY e.date_debut_evenement ASC";
    $stmt = $bdd->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getUserEvents($id_utilisateur) {
    $bdd = get_bdd();
    $sql = "SELECT e.*, u.nom_utilisateur, u.prenom_utilisateur, t.nom_type_evenement
            FROM EVENEMENT e
            LEFT JOIN UTILISATEUR u ON u.id_utilisateur = e.id_utilisateur
            LEFT JOIN TYPEEVENEMENT t ON t.id_type_evenement = e.id_type_evenement
            INNER JOIN INSCRIRE i ON i.id_evenement = e.id_evenement
            WHERE i.id_utilisateur = ?
            ORDER BY e.date_debut_evenement DESC";
    $stmt = $bdd->prepare($sql);
    $stmt->execute([$id_utilisateur]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function createEvent($titre, $type, $description, $date_debut, $date_fin, $id_type_evenement, $id_utilisateur) {
    $bdd = get_bdd();
    $sql = "INSERT INTO EVENEMENT (titre_evenement, type_evenement, description_evenement, date_debut_evenement, date_fin_evenement, id_type_evenement, id_utilisateur)
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $bdd->prepare($sql);
    return $stmt->execute([$titre, $type, $description, $date_debut, $date_fin, $id_type_evenement, $id_utilisateur]);
}


function registerUserToEvent($id_utilisateur, $id_evenement) {
    $bdd = get_bdd();
    $sql = "INSERT INTO INSCRIRE (id_utilisateur, id_evenement) VALUES (?, ?)";
    $stmt = $bdd->prepare($sql);
    return $stmt->execute([$id_utilisateur, $id_evenement]);
}

function isUserRegisteredToEvent($id_utilisateur, $id_evenement) {
    $bdd = get_bdd();
    $sql = "SELECT COUNT(*) as count FROM INSCRIRE 
            WHERE id_utilisateur = ? AND id_evenement = ?";
    $stmt = $bdd->prepare($sql);
    $stmt->execute([$id_utilisateur, $id_evenement]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['count'] > 0;
}

function unregisterUserFromEvent($id_utilisateur, $id_evenement) {
    $bdd = get_bdd();
    $sql = "DELETE FROM INSCRIRE WHERE id_utilisateur = ? AND id_evenement = ?";
    $stmt = $bdd->prepare($sql);
    return $stmt->execute([$id_utilisateur, $id_evenement]);
}

function getEventParticipantsCount($id_evenement) {
    $bdd = get_bdd();
    $sql = "SELECT COUNT(*) as count FROM INSCRIRE WHERE id_evenement = ?";
    $stmt = $bdd->prepare($sql);
    $stmt->execute([$id_evenement]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['count'];
}

function getEventParticipants($id_evenement) {
    $bdd = get_bdd();
    $sql = "SELECT u.id_utilisateur, u.nom_utilisateur, u.prenom_utilisateur, u.email_utilisateur
            FROM UTILISATEUR u
            INNER JOIN INSCRIRE i ON i.id_utilisateur = u.id_utilisateur
            WHERE i.id_evenement = ?
            ORDER BY u.nom_utilisateur, u.prenom_utilisateur";
    $stmt = $bdd->prepare($sql);
    $stmt->execute([$id_evenement]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
