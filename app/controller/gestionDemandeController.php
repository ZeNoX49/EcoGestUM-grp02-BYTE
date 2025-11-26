<?php
require_once $_ENV['BONUS_PATH']."app/model/objetModel.php";;
class gestionDemandeController
{
    public function show()
    {
        $reservationEnAttente = getNewObjectForReservation();

        
        include $_ENV['BONUS_PATH']."app/view/gestionDemandeView.php";
    }
}