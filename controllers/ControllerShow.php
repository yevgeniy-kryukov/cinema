<?php

class ControllerShow extends Controller
{
    public function actionIndex($id)
    {	
        $dataView = $this->getDataViewHeader();
        $dataView['titleFilm'] = ModelShow::titleFilm($id);
        $dataView['listShow'] = ModelShow::showTimes($id);
        View::generate('/show/index.php', '/layouts/main.php', $dataView);
        return true;
    }
}