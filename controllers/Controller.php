<?php

class Controller 
{
    public function getDataViewHeader()
    {
        if (isset($_SESSION['category'])) {
            $idCat = $_SESSION['category'];
        } else {
            if (isset($_COOKIE['cinemaLastCategory'])) {
                $idCat = $_COOKIE['cinemaLastCategory'];    
            } else {
                $idCat = '*';
            }
        }
        
        return      [	'idUser' 	=> isset($_SESSION['idUser']) ? $_SESSION['idUser'] : 0,
                        'emailUser' => isset($_SESSION['emailUser']) ? $_SESSION['emailUser'] : '',
                        'idCat' 	=> $idCat,
                        'rating' 	=> isset($_SESSION['rating']) ? $_SESSION['rating'] : '*',
                        'listCat' 	=> Model::categoryList(),
                        'menuItem'  => 'home'
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
}
