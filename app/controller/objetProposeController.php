<?php
require_once "app/model/objetModel.php";

class objetProposeController
{
    public function show()
    {
        if(isset($_SESSION['user'])){
            $objets = getNbObjectPropUtilisateur($_SESSION['user']);
                
            // Sécurité : si la fonction renvoie false, on force un tableau vide
            if ($objets === false) {
                $objets = [];
            }

            include "app/view/objetProposeView.php";
            }
        else{
            header('Location: index.php?action=connexion/show');
        }
    }
}