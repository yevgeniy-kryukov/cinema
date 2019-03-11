<?php

namespace cinema\controllers;

use cinema\controllers\Controller;
use cinema\models\ModelTheaterHall;

class ControllerTheaterHall extends Controller
{
    public function actionIndex()
    {	
        $this->checkAccessAdmin();
        $dataView['menuItem'] = 'hall';
        $dataView['listTheaterHalls'] = ModelTheaterHall::getListTheaterHalls();
        $this->generate('theater_hall/index.php', 'layouts/admin.php', $dataView);
        return true;
    }
}