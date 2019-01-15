<?php

/*
Класс-маршрутизатор для определения запрашиваемой страницы.
> цепляет классы контроллеров и моделей;
> создает экземпляры контролеров страниц и вызывает действия этих контроллеров.
*/
class Route
{

    public static function Start()
    {
        // контроллер и действие по умолчанию
        $controllerName = 'Site';
        $actionName = 'Index';
        $actionParams = "";
        
        $routes = explode('/', $_SERVER['REQUEST_URI']);

        // получаем имя контроллера
        if ( !empty($routes[1]) ) {	
            $controllerName = $routes[1];
            $controllerName = ucfirst($controllerName);
        }
        
        // получаем имя экшена
        if ( !empty($routes[2]) ) {
            $actionName = $routes[2];
            $actionName = ucfirst($actionName);
        }
        
        for ($i = 3; $i < count($routes); $i++) {
            if (!empty($actionParams)) $actionParams = $actionParams . ',' . $routes[$i];
            else $actionParams = $routes[$i];
        }

        // добавляем префиксы
        $modelName = 'Model'.$controllerName;
        $controllerName = 'Controller'.$controllerName;
        $actionName = 'action'.$actionName;

        /*
        echo "Model: $modelName <br>";
        echo "Controller: $controllerName <br>";
        echo "Action: $actionName <br>";
        */

        // подцепляем файл с классом модели (файла модели может и не быть)

        $modelFile = $modelName.'.php';
        $modelPath = "models/".$modelFile;
        if (file_exists($modelPath)) {
            include "models/".$modelFile;
        }

        // подцепляем файл с классом контроллера
        $controllerFile = $controllerName.'.php';
        $controllerPath = "controllers/".$controllerFile;
        if (file_exists($controllerPath)) {
            include "controllers/".$controllerFile;
        } else {
            /*
            правильно было бы кинуть здесь исключение,
            но для упрощения сразу сделаем редирект на страницу 404
            */
            Route::errorPage404();
        }
        
        // создаем контроллер
        $controller = new $controllerName;
        $action = $actionName;
        $actionParamsArray = explode(',', $actionParams);
    
        if (method_exists($controller, $action) && (Route::checkMethodParam($controllerName, $actionName, $actionParamsArray))) {
            // вызываем действие контроллера
            //$controller->$action();
            $controller->actionDefault();
            call_user_func_array(array($controller, $action), $actionParamsArray);
        } else {
            // здесь также разумнее было бы кинуть исключение
            Route::errorPage404();
        }
    
    }

    public static function checkMethodParam($controllerName, $actionName, $actionParamsArray)
    {
        $res = true;
        $i = 0;
        $actionParamsCount = count(array_filter($actionParamsArray, 'strlen'));
        $md = new ReflectionMethod($controllerName, $actionName); //->getNumberOfRequiredParameters()
        if ($md->getNumberOfRequiredParameters() == $actionParamsCount) {
            $params = $md->getParameters();
            foreach ($params as $param) {
                if ( ( ($param->getType() == 'int') && is_numeric($actionParamsArray[$i]) && is_int(intval($actionParamsArray[$i])) ) 
                    || ( ($param->getType() == 'string') && is_string($actionParamsArray[$i]) ) ) 
                {
                    continue;
                } else {
                    $res = false;
                    break;
                }
                $i++;
            }
        } else {
            $res = false;
        }
        return $res;
    }

    public static function errorPage404()
    {
        $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
        header('Location:'.$host.'404');
    }
    
}
