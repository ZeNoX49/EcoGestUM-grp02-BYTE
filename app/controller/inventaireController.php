<?php
require_once $_ENV['BONUS_PATH']."app/model/objetModel.php";
require_once $_ENV['BONUS_PATH']."app/model/categorieModel.php";

class inventaireController
{
    public function show()
    {
        if(!isset($_SESSION['user_role'])){
            header('Location: index.php?action=connexion/show');
        }
        $search = isset($_GET['search']) ? trim($_GET['search']) : '';
        $category = isset($_GET['categorie']) ? $_GET['categorie'] : null;
        $etat = isset($_GET['etat']) ? $_GET['etat'] : null;
        $location = isset($_GET['location']) ? trim($_GET['location']) : '';
        
        $objets = getAllFilteredObjects($search, $category, $etat, $location);
        //$objets = getAllObject();
        $nbObjetsDisponibles = countObjectStatus($objets, 1);
        $nbObjetsReserve = countObjectStatus($objets, 2);
        $nbObjetsEnAttente = countObjectStatus($objets, 3);
        $nbObjetsRefusee = countObjectReserve($objets, 5);
        $categoriesList = getAllCategories();
        
        
        
        include $_ENV['BONUS_PATH']."app/view/inventaireView.php";
    }
}