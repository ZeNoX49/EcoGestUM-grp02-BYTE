<?php

class gestionController
{
    public function show()
    {
      //Récuperer le rôle de l'utilisateur
      if(!isset($_SESSION['user_role'])){
        header('Location: /ecogestum-grp12-byte/connexion/show');
      }
      $role = $_SESSION['user_role'];
        include "app/view/gestionView.php";
    }
}