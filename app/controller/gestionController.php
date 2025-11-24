<?php

class gestionController
{
    public function show()
    {
      //Récuperer le rôle de l'utilisateur
      if(!isset($_SESSION['user_role'])){
        header('Location: index.php?action=connexion/show');
      }
      $role = $_SESSION['user_role'];
        include $_ENV['BONUS_PATH']."app/view/gestionView.php";
    }
}