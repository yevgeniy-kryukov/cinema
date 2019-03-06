<?php

class Controller 
{

    const ADMIN_ROLE_NAME = 'admin';

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
                        'listCat' 	=> ModelFilmCategory::categoryList(),
                        'menuItem'  => 'home'
                    ];
    } 

    public function isGuest() 
    {
        if (!isset($_SESSION['idUser'])) {
            return true;
        }
        return false;
    }

    public function isAdmin()
    {
        $roleName = ModelUser::getUserRole($_SESSION['idUser']);
        if ($roleName == self::ADMIN_ROLE_NAME) return true;
        return false;
    }

    public function checkAccessUser()
    {
        if ($this->isGuest()) {
            header('Location:/user/signin');
            die;
        }
        return true;
    }

    public function checkAccessAdmin()
    {
        if ($this->isGuest()) {
            header('Location:/user/signin');
        } else {
            if (!$this->isAdmin()) {
                header('HTTP/1.0 403 Forbidden');
                echo 'You are forbidden!';
                die;
            }
        }
        return true;
    }

    public function generate($contentView, $layoutView, $dataView = null)
    {   
        if (is_array($dataView)) {
            extract($dataView);
        }
        
        include 'views/'.$layoutView;
    }
}
