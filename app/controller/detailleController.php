<?php

require_once $_ENV['BONUS_PATH']."app/model/objetModel.php";
require_once $_ENV['BONUS_PATH']."app/model/reservationModel.php";

class DetailleController
{
    public function show()
    {
        $objet = null;

        if(isset($_GET['id'])){
            $objet = getObject($_GET['id'])[0];
        }

        if(!$objet) {
            header('Location: index.php?action=catalogue/show');
            exit;
        }

        include $_ENV['BONUS_PATH']."app/view/detailleView.php";
    }

    public function reserver() {
        if (!isset($_SESSION['user_id'])) {
            $_SESSION['error_message'] = "Veuillez vous connecter pour réserver un objet.";
            header('Location: index.php?action=connexion/show');
            exit;
        }

        if (isset($_GET['id'])) {
            $idObjet = $_GET['id'];
            $idUser = $_SESSION['user_id'];

            if(createReservation($idUser, $idObjet)) {
                header('Location: index.php?action=mesReservations/show');
                exit;
            } else {
                header("Location: index.php?action=detaille/show&id=$idObjet&error=1");
                exit;
            }
        }

        header('Location: index.php?action=catalogue/show');
    }
}