<?php
require_once "app/model/objetModel.php";

class objetProposeController
{
    public function show()
    {
        if(isset($_SESSION['user'])){
            $objets = getNbObjectPropUtilisateur($_SESSION['user']);
            $nbAttente = countObjectStatus($objets, 3);
            $nbDisponible = countObjectStatus($objets, 1);
            $nbRserve = countObjectStatus($objets, 2);

            // Sécurité : si la fonction renvoie false, on force un tableau vide
            if (!$objets) {
                $objets = [];
            }

            include "app/view/objetProposeView.php";
            }
        else{
            header('Location: /ecogestum-grp12-byte/connexion/show');
        }
    }
    
    public function delete(){
      if(isset($_GET['deleteId'])) {
        deleteObject($_GET['deleteId']);
      }
      $this->show();
    }
}