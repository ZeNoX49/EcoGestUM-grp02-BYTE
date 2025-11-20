<?php

require_once "app/model/utilisateurModel.php";

class ConnexionController
{
    public function show()
    {
        include "app/view/connexionView.php";
    }

    public function connect(){
        if(!isUserExisting($_POST['mail'])) {
            $this->show();
            return;
        }

        if(!isUserPasswordCorrect($_POST['mail'],$_POST['mdp'])) {
            $this->show();
            return;
        }
        header('Location: index.php?action=catalogue/show');
    }
}