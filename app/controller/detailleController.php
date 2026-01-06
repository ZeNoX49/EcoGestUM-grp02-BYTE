<?php

require_once $_ENV['BONUS_PATH']."app/model/objetModel.php";
require_once $_ENV['BONUS_PATH']."app/model/reservationModel.php";
require_once $_ENV['BONUS_PATH']."app/model/pointCollecteModel.php";

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

        $monObjet = $objet["id_utilisateur"] == $_SESSION["user_id"];
        $hasPosition = false;
        if($objet["id_point_collecte"] !== null) {
            $pc = getPointCollecteById($objet["id_point_collecte"])[0];
            if($pc["longitude"] !== 0 && $pc["latitude"] !== 0) {
                $hasPosition = true;
            }
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