<?php

require_once "app/model/categorieModel.php";

class profilController
{
    public function show()
    {
        var_dump(getAllCategories());
        include $_ENV['BONUS_PATH']."app/view/profilView.php";
    }
}