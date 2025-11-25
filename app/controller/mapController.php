<?php

require_once $_ENV['BONUS_PATH']."app/model/mapModel.php";

class MapController
{
    public function show()
    {
        $objets_a_afficher = getObjetsDisponibles();

        include $_ENV['BONUS_PATH']."app/view/mapView.php";
    }
}