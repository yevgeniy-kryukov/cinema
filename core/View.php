<?php

class View
{
    
    //public $template_view; // здесь можно указать общий вид по умолчанию.
    
    /*
    $content_file - виды отображающие контент страниц;
    $template_file - общий для всех страниц шаблон;
    $dataView - массив, содержащий элементы контента страницы. Обычно заполняется в модели.
    */
    public function generate($contentView, $templateView, $dataView = null)
    {
       
        extract($_SESSION['templateViewHeader']);
        if(is_array($dataView)) {
            // преобразуем элементы массива в переменные
            extract($dataView);
        }
        
        
        /*
        динамически подключаем общий шаблон (вид),
        внутри которого будет встраиваться вид
        для отображения контента конкретной страницы.
        */
        include 'views/'.$templateView;
    }
}
