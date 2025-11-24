<?php

class inventaireController
{
    public function show()
    {
        include $_ENV['BONUS_PATH']."app/view/inventaireView.php";
    }
}