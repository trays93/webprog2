<?php

class Router
{
    private static array $routes = [];
    private string $controller = "Index";
    private string $action = "index";
    private int $id = 0;
    private Request $request;

    public function __construct(Request $request)
    {
       $this->request = $request;

       $path = array_values(array_filter(explode('/', $this->request->getPath()), function ($value) {
           return trim($value) !== '';
       }));

       if(isset($path[0]) && trim($path[0]) !== '') {
           $this->controller = trim($path[0]);
       }

       if (isset($path[1]) && trim($path[1]) !== '') {
           $this->action = trim($path[1]);
       }

       if (isset($path[2]) && trim($path[2]) !== '' && is_numeric(trim($path[2]))) {
           $this->id = (int) trim($path[2]);
       }
    }

    public function route() {
        $route = [
            'method'        => $this->request->getMethod(),
            'controller'    => $this->controller,
            'action'        => $this->action,
        ];

        if (in_array($route, Router::$routes, true)) {

            $controller = $this->controller . 'Controller';
            $action = $this->action . 'Action';
            $class = new ReflectionClass($controller);

            if ($class->getConstructor() !== NULL) {
                $controller = new $controller(Database::getConnection());
            } else {
                $controller = new $controller();
            }
            if ($class->hasMethod($action)) {
                $method = new ReflectionMethod($controller, $action);

                if (!empty($method->getParameters())) {
                    $method->invoke($controller, $this->request, $this->id);
                } else {
                    $method->invoke($controller);
                }
            }

        } else {
            return new View('error', '404', []);
        }
    }

    public static function get(string $controllerName, string $actionName): void
    {
        Router::$routes[] = [
            'method'        => Request::METHOD_GET,
            'controller'    => $controllerName,
            'action'        => $actionName,
        ];
    }

    public static function post(string $controllerName, string $actionName): void
    {
        Router::$routes[] = [
            'method'        => Request::METHOD_POST,
            'controller'    => $controllerName,
            'action'        => $actionName,
        ];
    }

    public static function put(string $controllerName, string $actionName): void
    {
        Router::$routes[] = [
            'method'        => Request::METHOD_PUT,
            'controller'    => $controllerName,
            'action'        => $actionName,
        ];
    }

    public static function delete(string $controllerName, string $actionName): void
    {
        Router::$routes[] = [
            'method'        => Request::METHOD_DELETE,
            'controller'    => $controllerName,
            'action'        => $actionName,
        ];
    }
}
