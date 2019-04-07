<?php

namespace cinema\controllers;

use cinema\controllers\Controller;
use cinema\models\ModelTheater;

class ControllerTheater extends Controller
{
    public function actionIndex()
    {	
        $this->checkAccessAdmin();
        $dataView['menuItem'] = 'theater';
        $dataView['listTheaters'] = ModelTheater::getListTheaters();
        $this->generate('theater/index.php', 'layouts/admin.php', $dataView);
        return true;
    }

    public function actionPriceList($idTheater)
    {	
        $this->checkAccessAdmin();
        echo json_encode(ModelTheater::getTheaterPrice($idTheater));
        return true;
    }
}