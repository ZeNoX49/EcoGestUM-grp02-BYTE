<?php

require_once "app/model/utilisateurModel.php";

class connexionController
{
    public function show()
    {
        include "app/view/connexionView.php";
    }

    public function connect(){
        session_start();

        if(!isUserExisting($_POST['mail'])) {
            $_SESSION['error_message'] = "Adresse email ou mot de passe incorrect.";
            $this->show();
            return;
        }

        if(!isUserPasswordCorrect($_POST['mail'],$_POST['mdp'])) {
            $_SESSION['error_message'] = "Adresse email ou mot de passe incorrect.";
            $this->show();
            return;
        }

        $_SESSION['user_mail'] = $_POST['mail'];
        header('Location: index.php?action=catalogue/show');
    }
}