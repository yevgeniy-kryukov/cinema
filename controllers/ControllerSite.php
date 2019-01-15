<?php

class ControllerSite extends Controller
{
    public function __construct()
    {
        $this->view = new View();
        $this->model = new ModelSite();
    }

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
        $dataView['listTopFilm'] = $this->model->topFilms($idCat, $rating);
        $dataView['catName'] = $this->model->categoryName($idCat);
        $this->view->generate('/site/index.php', '/layouts/main.php', $dataView);
        return true;
    }

    public function actionAbout()
    {	
        $this->view->generate('/site/about.php', '/layouts/main.php', $this->getDataViewHeader());
        return true;
    }
}