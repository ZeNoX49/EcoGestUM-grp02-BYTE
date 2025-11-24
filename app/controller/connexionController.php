<?php

require_once $_ENV['PATH']."app/model/utilisateurModel.php";

class connexionController
{
    public function show()
    {
        include $_ENV['PATH']."app/view/connexionView.php";
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

        $user = getUserByMail($_POST['mail']);
        $_SESSION['user_id'] = $user['id_utilisateur'];
        $_SESSION['user_role'] = $user['id_role'];

        $_SESSION['user_mail'] = $_POST['mail'];
        header('Location: index.php?action=homePage/show');
    }
}