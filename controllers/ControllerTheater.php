<?php

class ControllerTheater extends Controller
{
    public function actionIndex()
    {	
        if (!$this->isGuest()) {
            $dataView['menuItem'] = 'theater';
            $dataView['listTheaters'] = ModelTheater::getListTheaters();
            $this->generate('theater/index.php', 'layouts/admin.php', $dataView);
        }
        
        return true;
    }
}