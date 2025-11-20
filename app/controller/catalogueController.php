<?php

require_once "app/model/objetModel.php";

class CatalogueController
{
    public function show()
    {
        //TODO Récupérer la liste du catalogue et les afficher
        $objets = getObjectDisponible();

        include "app/view/catalogueView.php";
    }
}