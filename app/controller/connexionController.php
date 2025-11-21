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
          $this->show();
            return;
        }
        $user = getUserByMail($_POST['mail']);


        $_SESSION['user'] = $user[0];
        header('Location: /ecogestum-grp12-byte/homePage/show');
    }
  public function deconnexion(){
    session_destroy();
    $this->show();
    }
}