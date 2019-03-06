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

    private function error404()
	{
        header('HTTP/1.1 404 Not Found');
        header('Location: /404');
    }

    public function run()
    {
        $uri = $this->getURI();

        $result = null;

        foreach ($this->routes as $uriPattern => $path) {

            if (preg_match("~^$uriPattern$~", $uri)) {

                $internalRoute = preg_replace("~^$uriPattern$~", $path, $uri);

                $segments = explode('/', $internalRoute);

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

        if ($result == null) {
            $this->error404();
        }
    }
    
}
