<?php

/**
 * Ez az osztály végzi el az URL alapján a routing-ot,
 * hogy melyik controller action fusson le.
 * 
 * URL paraméter alapján választja ki a controllert?
 * HTTP kulcsszó alapján routing (getAction, postAction, stb...)?
 */
class Router
{
    /**
     * A példányosítani kívánt Controller osztály neve.
     * 
     * @var string
     */
    private static $controller = 'IndexController';

    /**
     * A Controller osztályon meghívni kívánt metódus neve.
     * 
     * @var string
     */
    private static $controllerAction = 'indexAction';

    /**
     * @var array
     */
    private static $vars = [];

    /**
     * A metódus a beérkező URL-t feldarabolja a '/'-ek mentén,
     * az első paraméterből a használni kívánt Controller nevét,
     * a második a Controlleren meghívandó metódus nevét hordozza.
     *
     * @return void
     */
    public static function route()
    {
        $request = $_SERVER['QUERY_STRING'];

        if ($request != '') {
            $params = explode('/', $request);

            switch(count($params)) {
                case 1:
                    Router::$controller = trim(ucfirst(array_shift($params))) . 'Controller';
                    break;
                case 2:
                    Router::$controller = trim(ucfirst(array_shift($params))) . 'Controller';
                    Router::$controllerAction = trim(ucfirst(array_shift($params))) . 'Action';
                    break;
                default:
                Router::$controller = trim(ucfirst(array_shift($params))) . 'Controller';
                Router::$controllerAction = trim(ucfirst(array_shift($params))) . 'Action';
                break;
            }
        }

        if (class_exists(Router::$controller)) {
            $controller = new Router::$controller();
            $class = new ReflectionClass($controller);
            if ($class->hasMethod(Router::$controllerAction)) {
                $method = new ReflectionMethod($controller, Router::$controllerAction);
                $method->invoke($controller);
            } else {
                // TODO: 404
                return new View('error', '404', []);
            }
        } else {
            // TODO: 404
            return new View('error', '404', []);
        }
    }
}
