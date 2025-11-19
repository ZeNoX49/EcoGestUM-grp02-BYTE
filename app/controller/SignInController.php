<?php

require_once "app/model/utilisateurModel.php";

class signInController {
    public function show() {
        include "app/view/signIn.php";
    }

    public function signUp() {
        //TODO Verif mdp, existence d'un compte avec ce mail
        if(isset($_POST['mdp']) && isset($_POST['confirmMdp'])){
            if($_POST['mdp'] === $_POST['confirmMdp']){
                insertUser( $_POST['nom'], $_POST['prenom'],$_POST['mail'], $_POST['mdp'], 1);
                header('Location: index.php?action=Connexion/show');
            } else {
                $this->show();
            }
        }
        else {
            $this->show();
        }

    }
}
