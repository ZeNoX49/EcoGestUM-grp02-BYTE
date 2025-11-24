<?php

class homePageController
{
    public function show()
    {
        include $_ENV['BONUS_PATH'].'app/view/homePageView.php';
    }
}