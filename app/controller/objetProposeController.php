<?php

require_once $_ENV['BONUS_PATH']."app/model/objetModel.php";

class objetProposeController
{
    public function show()
    {
        if(isset($_SESSION['user_id'])){
            $objets = getNbObjectPropUtilisateur($_SESSION['user_id']);
            $nbAttente = countObjectStatus($objets, 3);
            $nbDisponible = countObjectStatus($objets, 1);
            $nbRserve = countObjectStatus($objets, 2);

            // Sécurité : si la fonction renvoie false, on force un tableau vide
            if (!$objets) {
                $objets = [];
            }

            include $_ENV['BONUS_PATH']."app/view/objetProposeView.php";
        }
        else{
            header('Location: index.php?action=connexion/show');
        }
    }
    
    public function delete(){
        if(isset($_GET['deleteId'])) {
            deleteObject($_GET['deleteId']);
        }
        $this->show();
    }
}