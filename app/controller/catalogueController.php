<?php

require_once $_ENV['BONUS_PATH']."app/model/objetModel.php";
require_once $_ENV['BONUS_PATH']."app/model/categorieModel.php";

class catalogueController
{
    public function show()
    {
        //Récupération des filtres depuis GET
        $search = isset($_GET['search']) ? trim($_GET['search']) : '';
        $category = isset($_GET['category']) ? $_GET['category'] : null;
        $etat = isset($_GET['etat']) ? $_GET['etat'] : null;
        $location = isset($_GET['location']) ? trim($_GET['location']) : '';

        //Récupération des données filtrées
        $objets = getFilteredObjects($search, $category, $etat, $location);


        //Récupération des listes pour les menus déroulants
        $categoriesList = getAllCategories();
        $etatsList = getAllEtats();
        $locationsList = getAllLocations();

   
        //Chargement de la vue
        include $_ENV['BONUS_PATH']."app/view/catalogueView.php";
    }
}