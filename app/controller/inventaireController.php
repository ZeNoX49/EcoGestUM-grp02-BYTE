<?php
require_once $_ENV['BONUS_PATH']."app/model/objetModel.php";
require_once $_ENV['BONUS_PATH']."app/model/categorieModel.php";
require_once $_ENV['BONUS_PATH']."app/model/statutDisponibleModel.php";

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
        $statut = isset($_GET['statut']) ? $_GET['statut'] : null;
        $objetsFiltered = getAllFilteredObjects($search, $category, $etat, $location, $statut);
        $objets = getAllObject();
        $nbObjetsDisponibles = countObjectStatus($objets, 2);
        $nbObjetsReserve = countObjectStatus($objets, 3);
        $nbObjetsEnAttente = countObjectStatus($objets, 1);
        $nbObjetsRefusee = countObjectReserve($objets, 4);
        $categoriesList = getAllCategories();
        $statutList = getAllStatutDisponible();
        $correspStyleStatutDisponible = ['En attente' =>'badge-yellow', 'Disponible' => 'badge-green', 'Indisponible'=>'badge-red', 'Reserve' => 'badge-blue'];
        
        
        
        
        include $_ENV['BONUS_PATH']."app/view/inventaireView.php";
    }
}