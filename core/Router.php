<?php

/**
 * Class Router
 * Route builder
 */
class Router
{

    private $routes;

    public function __construct() 
    {
        $routesPath = ROOT . '/config/routes.php';
        $this->routes = include($routesPath);
    }

    private function getURI() 
    {
        if (!empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }

    public function run()
    {

        $uri = $this->getURI();

        foreach ($this->routes as $uriPattern => $path) {

            if (preg_match("~^$uriPattern$~", $uri)) {
                //echo '|uriPattern '.$uriPattern.',path '.$path.'|';
                //echo '|'.$uriPattern.'|';
                //echo preg_replace("~$uriPattern~", $path, $uri);

                $internalRoute = preg_replace("~^$uriPattern$~", $path, $uri);

                $segments = explode('/', $internalRoute);
                //print_r($segments);

                $controllerName = array_shift($segments);
                $controllerName = 'Controller' . ucfirst($controllerName);

                $actionName = array_shift($segments);
                $actionName = 'action' . ucfirst($actionName);
                
                $parameters = $segments;

                $controllerObject = new $controllerName;

                $result = call_user_func_array(array($controllerObject, $actionName), $parameters);

                if ($result != null) {
                    break;
                } 
            }
        }
    }

    
}
