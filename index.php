<?php
define('SERVER_ROOT', "{$_SERVER['DOCUMENT_ROOT']}/");

//XAMP
define('SITE_ROOT', 'http://beadando.io'); 

// ONLINE
//define('SITE_ROOT', 'http://bazol.nhely.hu');

require_once(SERVER_ROOT . 'includes/Router.php');
require_once(SERVER_ROOT . 'includes/Request.php');
require_once(SERVER_ROOT . 'includes/Autoloader.php');
require_once(SERVER_ROOT . 'includes/View.php');
require_once(SERVER_ROOT . 'includes/Database.php');
require_once(SERVER_ROOT . 'includes/Menu.php');
require_once(SERVER_ROOT . 'includes/MenuController.php');

Autoloader::loadControllers();
Autoloader::loadModels();

session_start();

// MVC kontrollerek
Router::get('Index', 'index');
Router::get('Index', 'computers');
Router::get('Register', 'index');
Router::post('Register', 'index');
Router::get('Login', 'index');
Router::post('Login', 'index');
Router::get('Logout', 'index');
Router::post('Logout', 'index');
Router::get('Pdf','index');
Router::post('Pdf','index');
Router::post('Pdf', 'getRooms');
Router::post('Pdf', 'getIps');
Router::post('Pdf', 'getSoftwares');
Router::post('Pdf', 'getAll');
Router::post('Pdf','create');
Router::get('Index', 'chart');

// REST kontrollerek
Router::get('ComputersRest', 'getComputers');
Router::get('ComputersRest', 'getComputer');
Router::post('ComputersRest', 'insertComputer');
Router::put('ComputersRest', 'updateComputer');
Router::delete('ComputersRest', 'deleteComputer');

$request = new Request($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI'], $_GET, $_POST);
$router = new Router($request);
$router->route();
