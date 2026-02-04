<?php
require_once $_ENV['BONUS_PATH']."app/model/notificationModel.php";
class notificationController
{
    public function show(){
        if(!isset($_SESSION['user_id'])){
            header('Location: index.php?action=connexion/show');
        }
        $notifications = getNotification($_SESSION['user_id']);
        include $_ENV['BONUS_PATH'].'app/view/notificationView.php';
    }
    public function erase(){
        if(!isset($_SESSION['user_id'])){
            header('Location: index.php?action=connexion/show');
        }
        if (isset($_POST['id'])) {
            $id = intval($_POST['id']);
            removeNotificationId($id, $_SESSION['user_id']);
            echo "success";
        }
    }
    
    public function getCount(){
        if(!isset($_SESSION['user_id'])){
            header('Location: index.php?action=connexion/show');
        }
        echo getCountNotification($_SESSION['user_id']);
    }
    
    
}