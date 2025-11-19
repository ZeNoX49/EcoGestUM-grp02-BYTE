<?php
class ConnexionController
{
    public function show()
    {
        include "app/view/connexionView.php";
    }

    public function connect(){
        if(!(isset($_POST['mail']) && isset($_POST['mdp']))) {
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