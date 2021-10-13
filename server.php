<?php

define('SERVER_ROOT', "{$_SERVER['DOCUMENT_ROOT']}/beadando/");
define('FILE_NAME', "lotto.wsdl");

require_once(SERVER_ROOT . 'includes/Database.php');
require_once(SERVER_ROOT . 'includes/Autoloader.php');
require_once(SERVER_ROOT . 'soap/WSDLDocument.php');
require_once(SERVER_ROOT . 'soap/Lotto.php');

Autoloader::loadModels();

function generateWSDLDocument() {
    $wsdl = new WSDLDocument('Lotto', "http://localhost/beadando/server.php", "http://localhost/beadando/");
	$wsdl->formatOutput = true;
	$wsdlfile = $wsdl->saveXML();
	file_put_contents (FILE_NAME , $wsdlfile);
}

if (!file_exists(FILE_NAME)) {
    generateWSDLDocument();
}

$options = [
    'location' => "http://localhost/beadando/server.php",
    'uri' => "http://localhost/beadando/server.php",
    'keep_alive' => false,
    'trace' => true,
];

$server = new SoapServer(FILE_NAME, $options);
$server->setClass(Lotto::class);
$server->handle();
