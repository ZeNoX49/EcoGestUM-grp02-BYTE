<?php
require_once $_ENV['BONUS_PATH']."app/model/objetModel.php";;
class gestionDemandeController
{
    public function show()
    {
        $allObjet = getAllObject();
        $nbObjets = count($allObjet);
        $demandeNouvObjetEnAttente = getNewObjectForReservation();
        $nbObjAttente = count($demandeNouvObjetEnAttente);
        $reservationAccepter = getObjectDisponible();
        $nbReservationAccepter = count($reservationAccepter);
        $reservationRefuser = getObjectIndiponible();
        $nbReservationRefuser = count($reservationRefuser);
        
        include $_ENV['BONUS_PATH']."app/view/gestionDemandeView.php";
    }
    public function refuser(){
        if(isset($_GET['refuseId'])){
            refuserObject($_GET['refuseId']);
        }
        $this->show();
    }
    
    public function accepter(){
        if(isset($_GET['acceptId'])){
            accepterObject($_GET['acceptId']);
        }
        $this->show();
    }
}