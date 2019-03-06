<?php

class ControllerFilm extends Controller
{

    public function actionIndex()
    {	
        $this->checkAccessAdmin();
        $dataView['menuItem'] = 'film';
        $dataView['listFilms'] = ModelFilm::getListFilms();
        $this->generate('film/index.php', 'layouts/admin.php', $dataView);
        return true;
    }

    public function actionView($id)
    {	
        $this->checkAccessAdmin();
        $dataView['menuItem'] = 'film';
        $dataView['film'] = ModelFilm::getFilmById($id);
        $this->generate('film/view.php', 'layouts/admin.php', $dataView);
        return true;
    }

    public function actionUpdate($id)
    {	
        $this->checkAccessAdmin();

        $errors = false;

        if (isset($_POST['submit'])) {
            $title = $_POST['title'];
            $description = $_POST['description'];
            $category = $_POST['category'];
            $length = $_POST['length'];
            $rating = $_POST['rating'];
            $playingNow = isset($_POST['playingnow']) ? 1 : 0;

            if (!$title) $errors[] = 'Field "Title" is empty';
            if (!$description) $errors[] = 'Field "Description" is empty';
            if (!$length) $errors[] = 'Field "Length" is empty';
            if ( (!is_numeric($length)) || !is_int(0 + $length) ) $errors[] = 'The contents of the field "Length" is not the right type';

            if ($errors == false) {
                $result = ModelFilm::updateFilm($id, $title, $description, $category, $length, $rating, $playingNow);
                if ($result) {
                    header('location: /film/index');
                }
            }
        }

        $dataView['menuItem'] = 'film';
        $dataView['film'] = ModelFilm::getFilmById($id);
        $dataView['listCategories'] = ModelFilmCategory::categoryList();
        $dataView['errors'] = $errors;
        $this->generate('film/update.php', 'layouts/admin.php', $dataView);
        
        return true;
    }

    public function actionCreate()
    {	
        $this->checkAccessAdmin();

        $errors = false;

        if (isset($_POST['submit'])) {
            $title = $_POST['title'];
            $description = $_POST['description'];
            $category = $_POST['category'];
            $length = $_POST['length'];
            $rating = $_POST['rating'];
            $playingNow = isset($_POST['playingnow']) ? 1 : 0;

            if (!$title) $errors[] = 'Field "Title" is empty';
            if (!$description) $errors[] = 'Field "Description" is empty';
            if (!$length) $errors[] = 'Field "Length" is empty';
            if ( (!is_numeric($length)) || !is_int(0 + $length) ) $errors[] = 'The contents of the field "Length" is not the right type';

            if ($errors == false) {
                $result = ModelFilm::createFilm($title, $description, $category, $length, $rating, $playingNow);
                if ($result) {
                    header('location: /film/index');
                }
            }
        }

        $dataView['menuItem'] = 'film';
        $dataView['listCategories'] = ModelFilmCategory::categoryList();
        $dataView['errors'] = $errors;
        $this->generate('film/create.php', 'layouts/admin.php', $dataView);
        
        return true;
    }
}