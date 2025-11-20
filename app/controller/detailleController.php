<?php

class detailleController
{
    public function show()
    {
        if(isset($_GET['id'])){
            $conn = getDatabase();
            $objet = getObjet($_GET['id'], $conn);
        }
        include "app/view/detailleView.php";
    }
}