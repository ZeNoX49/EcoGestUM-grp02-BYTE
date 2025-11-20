<?php

require_once "app/model/utilisateurModel.php";

class ConnexionController
{
    public function show()
    {
        include "app/view/connexionView.php";
    }

    public function connect(){
        echo isUserExisting($_POST['mail']);
        
        if(!isUserExisting($_POST['mail'])) {
            echo "L'utilisateur n'existe pas";
            $this->show();
            return;
        }

        if(!isUserPasswordCorrect($_POST['mail'],$_POST['mdp'])) {
            echo "Le mdp n'est pas bon";
            $this->show();
            return;
        }
        
        header('Location: index.php?action=catalogue/show');
    }
}