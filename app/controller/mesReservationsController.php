<?php

require_once "app/model/objetModel.php";
class mesReservationsController
{
    public function show()
    {
        $objets = getObjectReserve($_SESSION['user']);
        include "app/view/mesReservationsView.php";
    }
    
    public function add(){
      if(isset($_GET['idObjet'])){
          createReservation($_GET['idObjet'], $_SESSION['user']);
          header('Location: /ecogestum-grp12-byte/mesReservations/show');
      }
    }
}