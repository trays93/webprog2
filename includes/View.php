<?php

/**
 * A nézetet megjelenítő osztály
 */
class View
{
    /**
     * A betölteni kívánt nézet neve
     *
     * @var string
     */
    private $viewName;

    /**
     * A nézeten megjeleníteni kívánt adatok
     *
     * @var array
     */
    private $data;

    public function __construct(string $controllerName, string $viewName, array $data = [])
    {
        $file = SERVER_ROOT . 'views/' . strtolower($controllerName) . "/{$viewName}.php";
        if (file_exists($file)) {
            $this->viewName = $file;
        } else {
            // TODO: hiba?
        }
        $this->data = $data; // TODO: filterezni az adatokat?
    }

    public function assign($variable, $value)
    {
        $this->data[$variable] = $value;
    }

    public function __destruct()
    {
        $viewName = $this->viewName;
        include(SERVER_ROOT . 'views/main.php');
    }
}
