<?php
require_once $_ENV['BONUS_PATH']."app/model/reservationModel.php";;
class gestionDemandeController
{
    public function show()
    {
        $reservationEnAttente = getReservationsByStatut(1);
        $reservationRefusee = getReservationsByStatut(5);
        $reservationApprouvee = getReservationsByStatut(6);
        
        include $_ENV['BONUS_PATH']."app/view/gestionDemandeView.php";
    }
}