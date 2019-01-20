<?php

class ControllerSite extends Controller
{
    public function actionIndex()
    {	
        if (isset($_POST['category'])) {
            $_SESSION['category'] = $_POST['category'];
        }
    
        if (isset($_POST['rating'])) {
            $_SESSION['rating'] = $_POST['rating'];
        }

        $dataViewHeader = $this->getDataViewHeader();
        $idCat = $dataViewHeader["idCat"];
        $rating = $dataViewHeader["rating"];
        $dataView = $dataViewHeader;
        $dataView['listTopFilm'] = ModelSite::topFilms($idCat, $rating);
        $dataView['catName'] = ModelSite::categoryName($idCat);

        View::generate('/site/index.php', '/layouts/main.php', $dataView);

        return true;
    }

    public function actionAbout()
    {	
        $dataView = $this->getDataViewHeader();
        $dataView['menuItem'] = 'about'; // replace default value from $dataView['menuItem']

        View::generate('/site/about.php', '/layouts/main.php', $dataView);
        
        return true;
    }
}