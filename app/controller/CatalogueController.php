<?php

class CatalogueController
{
    public function show()
    {
        //TODO Récupérer la liste du catalogue et les afficher

        $conn = getDatabase();
        $objets = getCatalogue($conn);


        include "app/view/CatalogueView.php";

    }
}