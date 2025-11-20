<?php
class ConnexionController
{
    public function show()
    {
        include "app/view/ConnexionView.php";
    }

    public function connect(){
        $bdd = getDatabase();
        header('Location: index.php?action=catalogue/show');
    }
}