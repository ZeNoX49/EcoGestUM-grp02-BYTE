<?php
require "app/model/bddModel.php";
class signInController {
    public function show() {
        include "app/view/signIn.php";
    }

    public function signIn() {
        $bdd = getDatabase();
        //TODO Verif mdp, existence d'un compte avec ce mail
        createUser( $_POST['Nom'], $_POST['Prénom'],$_POST['email'], $_POST['password'], $_POST['type'], $bdd);
        include "app/view/signIn.php";
    }
}
