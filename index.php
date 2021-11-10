<?php

define('SERVER_ROOT', "{$_SERVER['DOCUMENT_ROOT']}/beadando/");

//XAMP
define('SITE_ROOT', 'http://localhost'); 

// ONLINE
// define('SITE_ROOT', 'http://hatoslotto.nhely.hu');

require_once(SERVER_ROOT . 'controllers/Router.php');
require_once(SERVER_ROOT . 'includes/Autoloader.php');
require_once(SERVER_ROOT . 'includes/View.php');
require_once(SERVER_ROOT . 'includes/Database.php');

Autoloader::loadControllers();
Autoloader::loadModels();

session_start();

Router::route();
