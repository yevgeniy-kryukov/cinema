<?php

class View
{
    public function generate($contentView, $layoutView, $dataView = null)
    {   
        if(is_array($dataView)) {
            extract($dataView);
        }
        
        include 'views/'.$layoutView;
    }
}
