<?php

class Controller404 extends Controller
{
    
    public function actionIndex()
    {
        $this->view->generate('404.php', '/layouts/main.php');
        return true;
    }

}
