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
        $idCat = $_SESSION["category"];
        $rating = $_SESSION["rating"];
        $dataView["listTopFilm"] = $this->model->topFilms($idCat, $rating);
        $dataView["catName"] = $this->model->categoryName($idCat);
        $this->view->generate('/site/index.php', '/layouts/main.php', $dataView);
    }

    public function actionAbout()
    {	
        $this->view->generate('/site/about.php', '/layouts/main.php');
    }
}