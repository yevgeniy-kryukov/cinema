<?php

class ControllerFilm extends Controller
{
    public function actionIndex()
    {	
        if (!$this->isGuest()) {
            $dataView['menuItem'] = 'film';
            $dataView['listFilms'] = ModelFilm::getListFilms();
            View::generate('film/index.php', 'layouts/admin.php', $dataView);
        }
        
        return true;
    }
}