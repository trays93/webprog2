<?php

/**
 * Az osztály feladata hogy az egyéni osztályokat
 * betöltse az alkalmazás számára.
 */
class Autoloader
{
    /**
     * Ez a metódus a Controller osztályokat
     * tölti be az alkalmazás számára.
     *
     * @return void
     */
    public static function loadControllers()
    {
        spl_autoload_register(function($className) {
            $className = ucfirst(trim($className));
            $file = SERVER_ROOT . "controllers/{$className}.php";
            if (file_exists($file)) {
                include_once($file);
            } else {
                throw new Exception("Nem tudom betölteni a(z) $file-t");
            }
        });
    }
}
