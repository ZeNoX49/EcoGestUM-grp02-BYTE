<?php
require "app/model/bddModel.php";
class signInController {
    public function show() {
        include "app/view/signIn.php";
    }

    public function signUp() {
        $bdd = getDatabase();
        //TODO Verif mdp, existence d'un compte avec ce mail
        if($_POST['Mdp'] === $_POST['ConfirmationMdp']){
            createUser( $_POST['Nom'], $_POST['Prénom'],$_POST['Mail'], $_POST['Mdp'], null, $bdd);
            header('Location: index.php?action=Connexion/show');
        } else {
            $this->show();
        }
    }
}
