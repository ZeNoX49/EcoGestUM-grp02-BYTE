<?php

class gestionController
{
    public function show()
    {
      //Récuperer le rôle de l'utilisateur
      if(!isset($_SESSION['role'])){
        header('Location: /ecogestum-grp12-byte/connexion/show');
      }
      $role = $_SESSION['role'];
        include "app/view/gestionView.php";
    }
}