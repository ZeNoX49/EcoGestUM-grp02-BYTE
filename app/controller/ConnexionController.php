<?php
class ConnexionController
{
    public function show()
    {
        include "app/view/Connexion.php";
    }

    public function connect(){
        $bdd = getDatabase();
        header('Location: index.php?action=catalogue/show');
    }
}