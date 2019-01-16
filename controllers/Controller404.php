<?php

class Controller404 extends Controller
{
    
    public function actionIndex()
    {
        View::generate('404.php', '/layouts/main.php');
        return true;
    }

}
