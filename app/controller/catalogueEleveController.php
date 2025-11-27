<?php
require_once $_ENV['BONUS_PATH']."app/model/objetModel.php";

class catalogueEleveController {

    public function show()
    {
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        if ($page < 1) $page = 1;

        $limit = 6;
        $offset = ($page - 1) * $limit;

        $objets = getStudentExchangeObjects($limit, $offset);

        $totalObjets = countStudentExchangeObjects();
        $totalPages = ceil($totalObjets / $limit);

        include $_ENV['BONUS_PATH'] . "app/view/catalogueEleveView.php";
    }
}
?>