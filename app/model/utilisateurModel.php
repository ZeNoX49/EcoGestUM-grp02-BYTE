<?php

require "bddModel.php";

function insertUser($name, $fname, $mail, $password, $id_role) {
    $bdd = get_bdd();
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $bdd->prepare('INSERT INTO UTILISATEUR (nom_utilisateur, prenom_utilisateur, email_utilisateur, mdp_utilisateur, id_role) 
                          VALUES (:nom_utilisateur, :prenom_utilisateur, :email_utilisateur, :mdp_utilisateur, :id_role)');
    return $stmt->execute([
        ':nom_utilisateur' => $fname,
        ':prenom_utilisateur' => $name,
        ':email_utilisateur' => $mail,
        ':mdp_utilisateur' => $hashedPassword,
        ':id_role' => $id_role
    ]);
}

function getUsers() {
    $bdd = get_bdd();
    $query = $bdd->query('SELECT * FROM UTILISATEUR');
    $users = $query->fetchAll(PDO::FETCH_ASSOC);
    return $users;
}

function getUser($id_user) {
    $bdd = get_bdd();
    $query = $bdd->query("SELECT * FROM UTILISATEUR WHERE id_utilisateur = '$id_user'");
    $user = $query->fetchAll(PDO::FETCH_ASSOC);
    return $user;
}
function getUserByMail($mail) {
    $bdd = get_bdd();
    $query = $bdd->query("SELECT id_utilisateur FROM utilisateur WHERE email_utilisateur LIKE '$mail'");
    return $query->fetch();
}

// function isUserExistingId($id_user){
//     $bdd = get_bdd();
//     $stmt = $bdd->prepare("SELECT COUNT(*) FROM utilisateur WHERE id_utilisateur = ".$id_user);
//     $stmt->execute();
//     return $stmt->fetchColumn() > 0;
// }

function isUserExisting($mail){
    $bdd = get_bdd();
    $stmt = $bdd->prepare("SELECT COUNT(*) FROM utilisateur WHERE email_utilisateur LIKE '$mail'");
    $stmt->execute();
    return $stmt->fetchColumn() > 0;
}

function isUserPasswordCorrect($mail, $password){
    if(!isUserExisting($mail)) return false;

    $bdd = get_bdd();
    $query = $bdd->query("SELECT * FROM UTILISATEUR WHERE email_utilisateur LIKE '$mail'");
    $user = $query->fetchAll(PDO::FETCH_ASSOC);

    return password_verify($password, $user[0]['mdp_utilisateur']);
}


