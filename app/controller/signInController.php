<?php
class signInController {
    public function show() {
        include $_ENV['BONUS_PATH']."app/view/signInView.php";
    }

    public function signUp() {
        // On vérifie que les mdp sont les même
        if($_POST['mdp'] !== $_POST['confirmMdp']) {
            //TODO: mettre une erreur
            $this->show();
            return;
        }

        // On créer l'addresse mail
        $addEtu = $_POST['role'] == "Etudiant" ? ".etu" : "";
        $mail = strtolower($_POST['prenom']).".".strtolower($_POST['nom']).$addEtu."@univ-lemans.fr";

        // on vérifie que l'utilisateur n'existe pas
        if(isUserExisting($mail)) {
            //TODO: mettre une erreur
            $this->show();
            return;
        }
        
        // on créer le compte de l'utilisateur
        if(!insertUser($_POST['prenom'], $_POST['nom'], $mail, $_POST['mdp'], 1)) {
            //TODO: mettre une erreur
            $this->show();
            return;
        }
        
        header('Location: index.php?action=Connexion/show');
    }
}
