<?php

class ControllerAdmin extends Controller
{
    
    public function actionIndex()
    {
        if (!$this->isGuest()) {
            View::generate('admin/site/index.php', 'layouts/admin.php');
        }
        return true;
    }

}
