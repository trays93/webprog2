<?php

define('SERVER_ROOT', "{$_SERVER['DOCUMENT_ROOT']}/beadando/");
define('SITE_ROOT', 'http://localhost/beadando');

require_once(SERVER_ROOT . 'controllers/Router.php');
require_once(SERVER_ROOT . 'includes/Autoloader.php');
require_once(SERVER_ROOT . 'includes/View.php');

Autoloader::loadControllers();

Router::route();
