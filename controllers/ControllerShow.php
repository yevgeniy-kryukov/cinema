<?php

class ControllerShow extends Controller
{

    public function actionIndex()
    {	
        $dataView['menuItem'] = 'show';
        $dataView['listShows'] = ModelShow::getShowsAll();

        View::generate('show/index.php', 'layouts/admin.php', $dataView);
        
        return true;
    }


    public function actionFilm($id)
    {	
        $dataView = $this->getDataViewHeader();
        $dataView['titleFilm'] = ModelShow::getTitleByFilmId($id);
        $dataView['listShows'] = ModelShow::getShowsByFilmId($id);

        View::generate('show/film.php', 'layouts/main.php', $dataView);
        
        return true;
    }
}