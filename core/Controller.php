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

    public function actionDefault()
    {
        if (isset($_POST['category'])) {
            $idCat = $_POST['category'];
            $_SESSION['category'] = $idCat;
        } else {
            if (isset($_SESSION['category'])) {
                $idCat = $_SESSION['category'];
            } else {
                $idCat = '*';
                $_SESSION['category'] = $idCat;
            }
        }
    
        if (isset($_POST['rating'])) {
            $rating = $_POST['rating'];
            $_SESSION['rating'] = $rating;
        } else {
            if (isset($_SESSION['rating'])) {
                $rating = $_SESSION['rating'];
            } else {
                $rating = '*';
                $_SESSION['rating'] = $rating;
            }
        }

        $dataView = [	'idUser' 	=> isset($_SESSION['idUser']) ? $_SESSION['idUser'] : 0,
                        'emailUser' => isset($_SESSION['emailUser']) ? $_SESSION['emailUser'] : '',
                        'idCat' 	=> $idCat,
                        'rating' 	=> $rating,
                        'listCat' 	=> $this->model->categoryList()
                    ];
        
        $_SESSION['templateViewHeader'] = $dataView;
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
