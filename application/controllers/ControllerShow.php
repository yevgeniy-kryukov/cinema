<?php

class ControllerShow extends Controller
{
    public function __construct()
    {
        $this->view = new View();
        $this->model = new ModelShow();
    }

    public function actionIndex(int $id)
    {	
        $dataView["titleFilm"] = $this->model->titleFilm($id);
        $dataView["listShow"] = $this->model->showTimes($id);
        $this->view->generate('/show/index.php', '/layouts/main.php', $dataView);
    }
}