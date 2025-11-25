<?php
require_once $_ENV['BONUS_PATH']."app/model/objetModel.php";
class inventaireController
{
    public function show()
    {
        if(!isset($_SESSION['user_role'])){
            header('Location: index.php?action=connexion/show');
        }
        $objets = getAllObject();
        $nbObjetsDisponibles = countObjectStatus($objets, 1);
        $nbObjetsReserve = countObjectStatus($objets, 2);
        $nbObjetsEnAttente = countObjectStatus($objets, 3);
        
        include $_ENV['BONUS_PATH']."app/view/inventaireView.php";
    }
}