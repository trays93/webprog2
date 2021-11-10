<?php

define('SERVER_ROOT', "{$_SERVER['DOCUMENT_ROOT']}/beadando/");
define('FILE_NAME', "lotto.wsdl");

//XAMP
define('SITE_ROOT', 'http://localhost');

// ONLINE
// define('SITE_ROOT', 'http://hatoslotto.nhely.hu');

require_once(SERVER_ROOT . 'includes/Database.php');
require_once(SERVER_ROOT . 'includes/Autoloader.php');
require_once(SERVER_ROOT . 'soap/WSDLDocument.php');
require_once(SERVER_ROOT . 'soap/Lotto.php');

Autoloader::loadModels();

function generateWSDLDocument() {
    $wsdl = new WSDLDocument('Lotto', SITE_ROOT . "/beadando/server.php", SITE_ROOT . "/beadando/");
	$wsdl->formatOutput = true;
	$wsdlfile = $wsdl->saveXML();
	file_put_contents (FILE_NAME , $wsdlfile);
}

if (!file_exists(FILE_NAME)) {
    generateWSDLDocument();
}

$options = [
    'location' => SITE_ROOT . "/beadando/server.php",
    'uri' => SITE_ROOT . "/beadando/server.php",
    'keep_alive' => false,
    'trace' => true,
];

$server = new SoapServer(FILE_NAME, $options);
$server->setClass(Lotto::class);
$server->handle();
