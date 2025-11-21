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
      if(!isset($_GET['id'])){
      $this->show();
      }
    }
}