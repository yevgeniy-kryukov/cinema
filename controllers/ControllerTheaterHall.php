<?php

class ControllerTheaterHall extends Controller
{
    public function actionIndex()
    {	
        if (!$this->isGuest()) {
            $dataView['menuItem'] = 'hall';
            $dataView['listTheaterHalls'] = ModelTheaterHall::getListTheaterHalls();
            View::generate('theater_hall/index.php', 'layouts/admin.php', $dataView);
        }
        
        return true;
    }
}