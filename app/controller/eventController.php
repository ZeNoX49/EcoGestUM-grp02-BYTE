<?php

require_once $_ENV['BONUS_PATH']."app/model/eventModel.php";

class EventController {
    public function show()
    {
        if (!isset($_SESSION['user_role'])) {
            header('Location: /ecogestum-grp12-byte/index.php?action=connexion');
            exit();
        }

        $role = $_SESSION['user_role'];
        $data = [];

        if (isset($_GET['date'])) {
            $parts = explode('-', $_GET['date']); 
            if (count($parts) === 3) {
                $year  = (int)$parts[0];
                $month = (int)$parts[1];
                $day   = (int)$parts[2];
            } else {
                $month = (int)date('m');
                $year  = (int)date('Y');
                $day   = (int)date('d');
            }
        } else {
            $month = isset($_GET['month']) ? (int)$_GET['month'] : (int)date('m');
            $year  = isset($_GET['year'])  ? (int)$_GET['year']  : (int)date('Y');
            $day   = isset($_GET['day'])   ? (int)$_GET['day']   : (int)date('d');
        }

        if ($month < 1) { $month = 12; $year--; }
        if ($month > 12) { $month = 1; $year++; }

        $daysInMonth = date('t', mktime(0, 0, 0, $month, 1, $year));
        if ($day < 1) $day = 1;
        if ($day > $daysInMonth) $day = $daysInMonth;

        $data['events'] = getAllEvents();
        $data['month']  = $month;
        $data['year']   = $year;
        $data['day']    = $day;

        if ($role === '2' || $role === '3') {
            include "app/view/eventTeacher.php";
        } else {
            include "app/view/eventStudent.php";
            exit();
        }
    }
}
?>