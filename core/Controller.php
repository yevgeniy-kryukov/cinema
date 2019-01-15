<?php

class Controller 
{
    
    public $model;
    public $view;
    
    public function __construct()
    {
        $this->view = new View();
        $this->model = new Model();
    }

    public function getDataViewHeader()
    {
        return      [	'idUser' 	=> isset($_SESSION['idUser']) ? $_SESSION['idUser'] : 0,
                        'emailUser' => isset($_SESSION['emailUser']) ? $_SESSION['emailUser'] : '',
                        'idCat' 	=> isset($_SESSION['category']) ? $_SESSION['category'] : '*',
                        'rating' 	=> isset($_SESSION['rating']) ? $_SESSION['rating'] : '*',
                        'listCat' 	=> $this->model->categoryList()
                    ];
    } 

    public function isGuest() 
    {
        if (!isset($_SESSION['idUser'])) {
            header('Location:/user/signin');
            return true;
        } 
        return false;
    }
    
/* 	// действие (action), вызываемое по умолчанию
    public function actionIndex($params)
    {
        // todo	
    } */
}
