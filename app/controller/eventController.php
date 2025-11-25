<?php

require_once $_ENV['BONUS_PATH']."app/model/eventModel.php";

class EventController {
    public function show()
    {
        if (!isset($_SESSION['user_role'])) {
            header('Location: /ecogestum-grp12-byte/connexion');
            exit();
        }
        $role = $_SESSION['user_role'];
        $data = [];

        if ($role === 'teacher' || $role === 'Presidence') {
            $data['events'] = getAllEvents();
            include "app/view/eventTeacher.php";
        } elseif ($role === 'student') {
            $data['events'] = getAllEvents();
            include "app/view/eventStudent.php";
        } else {
            include "app/view/eventStudent.php";
            exit();
        }
    }
}