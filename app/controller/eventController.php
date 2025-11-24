<?php

require_once "app/model/eventModel.php";

class EventController {
    public function show()
    {
      if(!isset($_SESSION['user_role'])){
        header('Location: /ecogestum-grp12-byte/event/show');
      }
      $role = $_SESSION['user_role'];
        if ($role === 'teacher') {
            include "app/view/eventTeacher.php";
        } elseif ($role === 'Presidence') {
            include "app/view/eventTeacher.php";
        } elseif ($role === 'student') {
            include "app/view/eventStudent.php";
        } else {
            header('Location: /ecogestum-grp12-byte/event/show');
        }
    }
}

?>