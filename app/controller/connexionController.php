<?php

require_once "app/model/utilisateurModel.php";

class connexionController
{
    public function show()
    {
        include "app/view/connexionView.php";
    }

    public function connect(){
      echo "Connexion en cours";
      if(!isUserExisting($_POST['mail'])) {
            $this->show();
            return;
        }

        if(!isUserPasswordCorrect($_POST['mail'],$_POST['mdp'])) {
          echo "L'utilisateur n'existe pas";
          $this->show();
            return;
        }
        $user = getUserByMail($_POST['mail']);


        $_SESSION['user'] = $user[0];
        header('Location: index.php?action=catalogue/show');
    }
  public function deconnexion(){
    session_destroy();
    $this->show();
    }
}