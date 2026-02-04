<?php
require_once $_ENV['BONUS_PATH']."app/model/bddModel.php";

function getNotification($userId){
    $sql = "SELECT * FROM NOTIFICATION JOIN RECEVOIR ON RECEVOIR.id_notification = NOTIFICATION.id_notification WHERE RECEVOIR.id_utilisateur = ?";
    $params = [$userId];
    return get($sql, $params);
}

function removeNotificationId(int $id, $userId)
{
    $sql = "DELETE FROM RECEVOIR WHERE id_notification = ? AND id_utilisateur = ?";
    $params = [$id, $userId];
    $sql2 = "DELETE FROM NOTIFICATION WHERE id_notification = ?";
    $params2 = [$userId];
    delete($sql, $params);
    return  delete($sql2, $params2);
}

function getCountNotification($id){
    $sql = "SELECT COUNT(*) as count FROM NOTIFICATION JOIN RECEVOIR ON RECEVOIR.id_notification = NOTIFICATION.id_notification WHERE RECEVOIR.id_utilisateur = ?";
    $params = [$id];
    return getCount($sql, $params);
}