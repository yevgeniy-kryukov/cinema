<?php

class ControllerTheater extends Controller
{
    public function actionIndex()
    {	
        if (!$this->isGuest()) {
            $dataView['menuItem'] = 'theater';
            $dataView['listTheaters'] = ModelTheater::getListTheaters();
            View::generate('theater/index.php', 'layouts/admin.php', $dataView);
        }
        
        return true;
    }
}