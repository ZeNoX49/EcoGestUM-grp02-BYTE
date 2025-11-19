<?php

require "bddModel.php";

function insertUser($fname, $name, $mail, $password, $id_role) {
    $bdd = get_bdd();
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $bdd->prepare('INSERT INTO UTILISATEUR (nom_user, prenom_user, email_user, mdp_user, id_role) 
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

// function isUserExistingId($id_user){
//     $bdd = get_bdd();
//     $stmt = $bdd->prepare("SELECT COUNT(*) FROM utilisateur WHERE id_utilisateur = ".$id_user);
//     $stmt->execute();
//     return $stmt->fetchColumn() > 0;
// }

function isUserExisting($mail){
    $bdd = get_bdd();
    $stmt = $bdd->prepare("SELECT COUNT(*) FROM utilisateur WHERE email_utilisateur = '$mail'");
    $stmt->execute();
    return $stmt->fetchColumn() > 0;
}

function isUserPasswordCorrect($mail, $password){
    if(!isUserExisting($mail)) return false;

    $bdd = get_bdd();
    $query = $bdd->query("SELECT * FROM UTILISATEUR WHERE email_utilisateur = '$mail'");
    $user = $query->fetchAll(PDO::FETCH_ASSOC);

    return password_verify($password, $user['mdp_utilisateur']);
}