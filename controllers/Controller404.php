<?php

class Controller404 extends Controller
{
    
    public function actionIndex()
    {
        View::generate('404.php', 'layouts/blank.php', $this->getDataViewHeader());
        
        return true;
    }

}
