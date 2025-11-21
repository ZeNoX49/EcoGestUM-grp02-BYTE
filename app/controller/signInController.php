<?php

require_once "app/model/utilisateurModel.php";

class signInController {
    public function show() {
        include "app/view/signInView.php";
    }

    public function signUp() {
        // On vérifie que les mdp sont les même
        if($_POST['mdp'] !== $_POST['confirmMdp']) {
            $this->show();
            return;
        }

        // On créer l'addresse mail
        $addEtu = $_POST['role'] == "Etudiant" ? ".etu" : "";
        $mail = strtolower($_POST['prenom']).".".strtolower($_POST['nom']).$addEtu."@univ-lemans.fr";

        // on vérifie que l'utilisateur n'existe pas
        if(isUserExisting($mail)) {
            $this->show();
            return;
        }
        
        // on créer le compte de l'utilisateur
        if(!insertUser($_POST['prenom'], $_POST['nom'], $mail, $_POST['mdp'], 1)) {
            $this->show();
            return;
        }
        header('Location: /ecogestum-grp12-byte/Connexion/show');
    }
}
