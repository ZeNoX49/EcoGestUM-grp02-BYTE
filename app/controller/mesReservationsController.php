<?php
require_once $_ENV['BONUS_PATH']."app/model/reservationModel.php";

class mesReservationsController
{
    public function show()
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?action=connexion/show');
            exit;
        }

        $reservations = getReservationsByUser($_SESSION['user_id']);
        $stats = [
            'actives' => 0,
            'pretes' => 0,
            'recuperees' => 0,
            'attente' => 0
        ];

        foreach($reservations as $res) {
            $stats['actives']++;
            if($res['id_statut_reservation'] == 1) $stats['attente']++;
            if($res['id_statut_reservation'] == 2) $stats['pretes']++; // Confirmée
            if($res['id_statut_reservation'] == 4) $stats['recuperees']++; // Complétée
        }

        include $_ENV['BONUS_PATH']."app/view/mesReservationsView.php";
    }

    public function cancel() {
        if (isset($_SESSION['user_id']) && isset($_GET['id'])) {
            cancelReservation($_SESSION['user_id'], $_GET['id']);
        }
        header('Location: index.php?action=mesReservations/show');
    }
    public function confirm() {
        if (isset($_SESSION['user_id']) && isset($_GET['id'])) {
            confirmReception($_SESSION['user_id'], $_GET['id']);
        }
        header('Location: index.php?action=mesReservations/show');
    }
}