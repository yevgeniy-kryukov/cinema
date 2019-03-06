<?php

class ControllerTheaterHall extends Controller
{
    public function actionIndex()
    {	
        if (!$this->isGuest()) {
            $dataView['menuItem'] = 'hall';
            $dataView['listTheaterHalls'] = ModelTheaterHall::getListTheaterHalls();
            $this->generate('theater_hall/index.php', 'layouts/admin.php', $dataView);
        }
        
        return true;
    }
}