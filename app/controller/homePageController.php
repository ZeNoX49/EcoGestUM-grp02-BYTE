<?php

class homePageController
{
    public function show()
    {
        include $_ENV['PATH'].'app/view/homePageView.php';
    }
}