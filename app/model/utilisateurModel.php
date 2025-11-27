<?php
require_once $_ENV['BONUS_PATH']."app/model/bddModel.php";

function insertUser($name, $fname, $mail, $password, $id_role, $id_depser) {
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $sql = 'INSERT INTO UTILISATEUR (nom_utilisateur, prenom_utilisateur, email_utilisateur, mdp_utilisateur, id_role, id_depser) 
            VALUES (?, ?, ?, ?, ?, ?)';
    $params = [$fname, $name, $mail, $hashedPassword, $id_role, $id_depser];
    return insert($sql, $params);
}

function getUsers() {
    $sql = "SELECT * FROM UTILISATEUR";
    return get($sql);
}

function getUser($id_user) {
    $sql = "SELECT * FROM UTILISATEUR WHERE id_utilisateur = ?";
    $params = [$id_user];
    return get($sql, $params);
}

function updateUser($id, $name, $fname, $mail) {
    $sql = "UPDATE UTILISATEUR SET 
            prenom_utilisateur = ? AND
            nom_utilisateur = ? AND
            email_utilisateur = ?
            WHERE id_utilisateur = ?";
    $params = [$name, $fname, $mail, $id];
    return update($sql, $params);
}

function updateUserPassword($id, $password) {
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $sql = "UPDATE UTILISATEUR SET mdp_utilisateur = ? WHERE id_utilisateur = ?";
    $params = [$hashedPassword, $id];
    return update($sql, $params);;
}

function isUserExisting($mail){
    $sql = "SELECT COUNT(*) FROM UTILISATEUR WHERE email_utilisateur LIKE '$mail'";
    return getCount($sql) > 0;
}

function isUserPasswordCorrect($mail, $password){
    if(!isUserExisting($mail)) return false;

    $sql = "SELECT * FROM UTILISATEUR WHERE email_utilisateur LIKE '$mail'";
    $user = get($sql);
    return password_verify($password, $user[0]['mdp_utilisateur']);
}

function getUserByMail($mail){
    $sql = "SELECT * FROM UTILISATEUR WHERE email_utilisateur = ?";
    $params = [$mail];
    return get($sql, $params);
}

function getEventUsers() {
    $sql = "SELECT * FROM UTILISATEUR WHERE id_role IN (2, 3)";
    return get($sql);
}