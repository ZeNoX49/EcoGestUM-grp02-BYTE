<?php
require_once $_ENV['BONUS_PATH']."app/model/reservationModel.php";;
class gestionDemandeController
{
    public function show()
    {
        $reservationEnAttente = getReservationsByStatutDisp(3);

        
        include $_ENV['BONUS_PATH']."app/view/gestionDemandeView.php";
    }
}