<?php

require_once $_ENV['BONUS_PATH']."app/model/bddModel.php";

// Récupère tous les événements
function getAllEvents() {
    $sql = "SELECT * FROM evenements_sauvegardes es
            ORDER BY es.date_debut_evenement DESC";
    return get($sql);
}

// Récupère un événement par son ID
function getEventById($id) {
    $sql = "SELECT * FROM evenements_sauvegardes es
            WHERE es.id_evenement = ?";
    $params = [$id];
    return get($sql, $params);
}

function getUpcomingEvents() {
    $sql = "SELECT * FROM evenements_sauvegardes es
            WHERE es.date_debut_evenement > NOW()
            ORDER BY es.date_debut_evenement ASC";
    return get($sql);
}

function getUserEvents($id_utilisateur) {
    $sql = "SELECT * FROM evenements_sauvegardes es
            INNER JOIN INSCRIRE i ON i.id_evenement = es.id_evenement
            WHERE i.id_utilisateur = ?
            ORDER BY es.date_debut_evenement DESC";
    $params = [$id_utilisateur];
    return get($sql, $params);
}

function createEvent($titre, $description, $date_debut, $date_fin, $id_type_evenement, $id_utilisateur) {
    $sql = "INSERT INTO EVENEMENT (titre_evenement, description_evenement, date_debut_evenement, date_fin_evenement, id_type_evenement, id_utilisateur)
            VALUES (?, ?, ?, ?, ?, ?)";
    $params = [$titre, $description, $date_debut, $date_fin, $id_type_evenement, $id_utilisateur];
    return insert($sql, $params);
}

function registerUserToEvent($id_utilisateur, $id_evenement) {
    $sql = "INSERT INTO INSCRIRE (id_utilisateur, id_evenement) VALUES (?, ?)";
    $params = [$id_utilisateur, $id_evenement];
    return insert($sql, $params);
}

function isUserRegisteredToEvent($id_utilisateur, $id_evenement) {
    $sql = "SELECT COUNT(*) as count FROM INSCRIRE 
            WHERE id_utilisateur = ? AND id_evenement = ?";
    $params = [$id_utilisateur, $id_evenement];
    return getCount($sql, $params) > 0;
}

function unregisterUserFromEvent($id_utilisateur, $id_evenement) {
    $sql = "DELETE FROM INSCRIRE WHERE id_utilisateur = ? AND id_evenement = ?";
    $params = [$id_utilisateur, $id_evenement];
    return delete($sql, $params);
}

function getEventParticipantsCount($id_evenement) {
    $sql = "SELECT COUNT(*) as count FROM INSCRIRE WHERE id_evenement = ?";
    $params = [$id_evenement];
    return getCount($sql, $params);
}

function getEventParticipants($id_evenement) {
    $sql = "SELECT u.id_utilisateur, u.nom_utilisateur, u.prenom_utilisateur, u.email_utilisateur
            FROM UTILISATEUR u
            INNER JOIN INSCRIRE i ON i.id_utilisateur = u.id_utilisateur
            WHERE i.id_evenement = ?
            ORDER BY u.nom_utilisateur, u.prenom_utilisateur";
    $params = [$id_evenement];
    return get($sql, $params);
}

function deleteEvent($id_event){
    $sqlDeleteInscriptions = "DELETE FROM INSCRIRE WHERE id_evenement = ?";
    $paramsInscriptions = [$id_event];
    delete($sqlDeleteInscriptions, $paramsInscriptions);
    
    $sql = "DELETE FROM EVENEMENT WHERE id_evenement = ?";
    $params = [$id_event];
    return delete($sql, $params);
}