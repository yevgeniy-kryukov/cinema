<?php

class ControllerShow extends Controller
{

    public function actionIndex()
    {	
        $dataView['menuItem'] = 'show';
        $dataView['listShows'] = ModelShow::getShowsAll();
        $this->generate('show/index.php', 'layouts/admin.php', $dataView);
        return true;
    }

    public function actionFilm($id)
    {	
        $dataView = $this->getDataViewHeader();
        $dataView['titleFilm'] = ModelShow::getTitleByFilmId($id);
        $dataView['listShows'] = ModelShow::getShowsByFilmId($id);
        $this->generate('show/film.php', 'layouts/main.php', $dataView);
        return true;
    }

    public function actionView($id)
    {	
        $this->checkAccessAdmin();
        $dataView['menuItem'] = 'show';
        $dataView['show'] = ModelShow::getShowData($id);
        $this->generate('show/view.php', 'layouts/admin.php', $dataView);
        return true;
    }

    public function actionUpdate($id)
    {	
        $this->checkAccessAdmin();

        $errors = false;

        if (isset($_POST['submit'])) {
            $film = $_POST['film'];
            $starttime = $_POST['starttime'];
            $dateshow = $_POST['dateshow'];
            $theaterhall = $_POST['theaterhall'];
            $adultprice = $_POST['adultprice'];
            $childprice = $_POST['childprice'];

            if (!$film) $errors[] = 'Field "Film" is empty';
            if (!$starttime) $errors[] = 'Field "Start time" is empty';
            if (!$dateshow) $errors[] = 'Field "Date show" is empty';
            if (!$theaterhall) $errors[] = 'Field "Theater hall" is empty';
            if (!$adultprice) $errors[] = 'Field "Adult price" is empty';
            if (!$childprice) $errors[] = 'Field "Child price" is empty';

            if (!Model::validateTime($starttime)) $errors[] = 'The contents of the field "Start time" is not the right type';
            if (!Model::validateDate($dateshow)) $errors[] = 'The contents of the field "Date show" is not the right type';
            if (!is_numeric($adultprice))  $errors[] = 'The contents of the field "Adult price" is not the right type';
            if (!is_numeric($childprice))  $errors[] = 'The contents of the field "Child price" is not the right type';

            if ($errors == false) {
                $result = ModelShow::updateShow($id, $film, $starttime, $dateshow, $theaterhall, $adultprice, $childprice);
                if ($result) {
                    header('location: /show/index');
                }
            }
        }

        $dataView['menuItem'] = 'show';
        $dataView['show'] = ModelShow::getShowData($id);
        $dataView['listTheaters'] = ModelTheater::getListTheaters();
        $dataView['listTheaterHalls'] = ModelTheaterHall::getListTheaterHalls();
        $dataView['listFilms'] = ModelFilm::getListFilms();
        $dataView['errors'] = $errors;
        $this->generate('show/update.php', 'layouts/admin.php', $dataView);
        
        return true;
    }

    public function actionCreate()
    {	
        $this->checkAccessAdmin();

        $errors = false;

        if (isset($_POST['submit'])) {
            $film = $_POST['film'];
            $starttime = $_POST['starttime'];
            $dateshow = $_POST['dateshow'];
            $theaterhall = $_POST['theaterhall'];
            $adultprice = $_POST['adultprice'];
            $childprice = $_POST['childprice'];

            if (!$film) $errors[] = 'Field "Film" is empty';
            if (!$starttime) $errors[] = 'Field "Start time" is empty';
            if (!$dateshow) $errors[] = 'Field "Date show" is empty';
            if (!$theaterhall) $errors[] = 'Field "Theater hall" is empty';
            if (!$adultprice) $errors[] = 'Field "Adult price" is empty';
            if (!$childprice) $errors[] = 'Field "Child price" is empty';

            if (!Model::validateTime($starttime)) $errors[] = 'The contents of the field "Start time" is not the right type';
            if (!Model::validateDate($dateshow)) $errors[] = 'The contents of the field "Date show" is not the right type';
            if (!is_numeric($adultprice)) $errors[] = 'The contents of the field "Adult price" is not the right type';
            if (!is_numeric($childprice)) $errors[] = 'The contents of the field "Child price" is not the right type';

            if ($errors == false) {
                $result = ModelShow::createShow($film, $starttime, $dateshow, $theaterhall, $adultprice, $childprice);
                if ($result) {
                    header('location: /show/index');
                    exit;
                }
            }
        }

        $dataView['menuItem'] = 'show';
        $dataView['listTheaters'] = ModelTheater::getListTheaters();
        $dataView['listTheaterHalls'] = ModelTheaterHall::getListTheaterHalls();
        $dataView['listFilms'] = ModelFilm::getListFilms();
        $dataView['errors'] = $errors;
        $this->generate('show/create.php', 'layouts/admin.php', $dataView);
        
        return true;
    }

}