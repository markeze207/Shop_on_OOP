<?php

class Router
{
    private mixed $routes;

    public function __construct()
    {
        $this->routes = include(ROOT.'/config/routers.php');
    }
    
    // returns request string
    private function getURI(): string
    {
        if(!empty($_SERVER['REQUEST_URI']))
        {
            return trim($_SERVER['REQUEST_URI'],'/');
        }
        return false;
    }
    public function run(): void
    {
        $uri = $this->getURI(); // Получаем URI
        foreach($this->routes as $uriPattern => $path) // Проходимся по массиву для перехода по классам
        {
            if(preg_match("~$uriPattern~", $uri)) // проверяем есть ли в массиве URI по которому мы перешли
            {

                $internalRoute = preg_replace("~$uriPattern~", $path, $uri); // в строке запроса, мы ищем параметры по шаблону в массиве
                // и подставляем в $path - $1, $2

                $segments = explode('/', $internalRoute); // делим ссылку
                $controllerName = array_shift($segments) . 'Controller'; // получаем контроллер
                $controllerName = ucfirst($controllerName);

                $actionName = 'action' . ucfirst(array_shift($segments)); // получаем action

                $controllerFile = ROOT . '/controllers/' . $controllerName . '.php'; // ищем путь

                if(file_exists($controllerFile)) // проверка на файл
                {
                    include_once($controllerFile);
                }

                $controllerObject = new $controllerName;
                $result = call_user_func_array(array($controllerObject, $actionName), $segments); // вызываем

                if($result != null)
                {
                    break;
                }
            }
        }
    }
}