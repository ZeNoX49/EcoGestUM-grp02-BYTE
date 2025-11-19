<?php

require_once "app/model/utilisateurModel.php";

class signInController {
    public function show() {
        include "app/view/signInView.php";
    }

    public function signUp() {
        // On vérifie que les champs sont remplis
        if(!(isset($_POST['mdp']) && isset($_POST['confirmMdp']))) {
            $this->show();
            return;
        }

        // On vérifie que les mdp sont les même
        if($_POST['mdp'] !== $_POST['confirmMdp']) {
            $this->show();
            return;
        }

        // On créer l'addresse mail
        $addEtu = $_POST['role'] == "Etudiant" ? ".etu" : "";
        $mail = strtolower($_POST['prenom']).".".strtolower($_POST['nom']).$addEtu."@univ-lemans.fr";

        // on vérifie que l'utilisateur n'existe pas
        if(!isUserExisting($mail)) {
            echo "L'utilisateur existe déja";
            $this->show();
            return;
        }

        // on créer le compte de l'utilisateur
        insertUser( $_POST['nom'], $_POST['prenom'], $mail, $_POST['mdp'], 1);
        header('Location: index.php?action=Connexion/show');
    }
}
