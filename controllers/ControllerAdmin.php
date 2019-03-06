<?php

class ControllerAdmin extends Controller
{
    
    public function actionIndex()
    {
        $this->checkAccessAdmin();
        $dataView['menuItem'] = 'home';
        $this->generate('admin/index.php', 'layouts/admin.php', $dataView);
        return true;
    }

}
