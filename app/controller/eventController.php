<?php

require_once "app/model/eventModel.php";

class EventController {
    public function show()
    {
        if(!isset($_SESSION['user_role'])){
            header('Location: index.php?action=event/show');
        }

        switch ($_SESSION['user_role']) {
            case 'teacher':
                include $_ENV['BONUS_PATH']."app/view/eventTeacher.php";
            case 'Presidence':
                include $_ENV['BONUS_PATH']."app/view/eventTeacher.php";
            case 'student':
                include $_ENV['BONUS_PATH']."app/view/eventStudent.php";
            default:
                header('Location: index.php?action=event/show');
        }
    }
}