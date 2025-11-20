<?php

require_once "app/model/objetModel.php";

class detailleController
{
    public function show()
    {
        if(isset($_GET['id'])){
            $objet = getObject($_GET['id']);
        }
        include "app/view/detailleView.php";
    }
}