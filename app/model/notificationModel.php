<?php
require_once $_ENV['BONUS_PATH']."app/model/bddModel.php";

function getNotification($userId){
    $sql = "SELECT * FROM NOTIFICATION JOIN RECEVOIR ON RECEVOIR.id_notification = NOTIFICATION.id_notification WHERE RECEVOIR.id_utilisateur = ?";
    $params = [$userId];
    return get($sql, $params);
}