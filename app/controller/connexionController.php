<?php
class connexionController
{
    public function show()
    {
        include "app/view/connexionView.php";
    }

    public function connect(){
        $bdd = getDatabase();
        header('Location: index.php?action=homePage/show');
    }
}