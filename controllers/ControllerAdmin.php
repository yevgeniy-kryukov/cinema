<?php

class ControllerAdmin extends Controller
{
    
    public function actionIndex()
    {
        if (!$this->isGuest()) {
            $dataView['menuItem'] = 'home';
            View::generate('admin/index.php', 'layouts/admin.php', $dataView);
        }
        return true;
    }

}
