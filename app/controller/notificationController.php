<?php
require_once $_ENV['BONUS_PATH']."app/model/notificationModel.php";
class notificationController
{
    public function show(){
        if(!isset($_SESSION['user_role'])){
            header('Location: index.php?action=connexion/show');
        }
        $notifications = getNotification($_SESSION['user_role']);
        include $_ENV['BONUS_PATH'].'app/view/notificationView.php';
    }
}