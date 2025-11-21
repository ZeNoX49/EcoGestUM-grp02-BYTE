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
      echo "Connexion en cours";
      if(!isUserExisting($_POST['mail'])) {
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
          $this->show();
            return;
        }
        $user = getUserByMail($_POST['mail']);


        $_SESSION['user'] = $user[0]['id_utilisateur'];
        $_SESSION['role'] = $user[0]['id_role'];
        header('Location: /ecogestum-grp12-byte/homePage/show');
    }
  public function deconnexion(){
    session_destroy();
    $this->show();
    }
}