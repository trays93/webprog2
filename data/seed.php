<?php

// XAMP

define('SERVER_NAME', '127.0.0.1');
define('PORT', 3306);
define('DATABASE_NAME', 'beadando');
define('USER_NAME', 'root');
define('PASSWORD', '');



// ONLINE
/*
define('SERVER_NAME', 'localhost');
define('DATABASE_NAME', 'fekez');
define('USER_NAME', 'fekez');
define('PASSWORD', 'JC!Pia!GRsfX4Y8');
*/

$conn = new PDO(
    // XAMP
    /*
    'mysql:host=' . SERVER_NAME . ':' . PORT . ';dbname=' . DATABASE_NAME,
    USER_NAME, PASSWORD); */

    // ONLINE
    'mysql:host=' . SERVER_NAME . ';dbname=' . DATABASE_NAME,
    USER_NAME, PASSWORD);

$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

echo "Csatlakozás...\n";

$file = fopen('./gep.txt', 'r');
if ($file) {
    $stmt = $conn->prepare("INSERT INTO gep (id, hely, tipus, ipcim) VALUES (:id, :hely, :tipus, :ipcim)");
    
    echo "\nGépek beszúrása...";

    $line = fgets($file);
    while(!feof($file)) {
        $line = fgets($file);
        $line = explode("\t", $line);
        if (count($line) === 4) {
            $stmt->bindValue(':id', trim($line[0]));
            $stmt->bindValue(':hely', trim($line[1]));
            $stmt->bindValue(':tipus', trim($line[2]));
            $stmt->bindValue(':ipcim', trim($line[3]));
            $stmt->execute();
        }
    }

    fclose($file);
    echo "Gépek beszúrva\n";
}

$file = fopen('./szoftver.txt', 'r');
if ($file) {
    $stmt = $conn->prepare("INSERT INTO szoftver (id, nev, kategoria) VALUES (:id, :nev, :kategoria)");
    
    echo "\nSzoftverek beszúrása...";

    $line = fgets($file);
    while(!feof($file)) {
        $line = fgets($file);
        $line = explode("\t", $line);
        if (count($line) === 3) {
            $stmt->bindValue(':id', trim($line[0]));
            $stmt->bindValue(':nev', trim($line[1]));
            $stmt->bindValue(':kategoria', trim($line[2]));
            $stmt->execute();
        }
    }

    fclose($file);
    echo "Szoftverek beszúrva\n";
}

$file = fopen('./telepites.txt', 'r');
if ($file) {
    $stmt = $conn->prepare("INSERT INTO telepites (gepid, szoftverid, verzio, datum) VALUES (:gepid, :szoftverid, :verzio, :datum)");
    
    echo "\nTelepítések beszúrása...";

    $line = fgets($file);
    while(!feof($file)) {
        $line = fgets($file);
        $line = explode("\t", $line);
        if (count($line) === 4) {
            $stmt->bindValue(':gepid', trim($line[0]));
            $stmt->bindValue(':szoftverid', trim($line[1]));
            $stmt->bindValue(':verzio', trim($line[2]));
            $stmt->bindValue(':datum', (trim($line[3]) === "") ? null : trim($line[3]));
            $stmt->execute();
        }
    }

    fclose($file);
    echo "Telepítések beszúrva\n";
}

$file = fopen('./oldalak.txt', 'r');
if ($file) {
    $stmt = $conn->prepare("INSERT INTO oldalak (id, tartalom, szulo_id, oldal_azonosito, kattinthato) VALUES (:id, :tartalom, :szulo_id, :oldal_azonosito, :kattinthato)");
    
    echo "\nMenuelemek beszúrása...";

    $line = fgets($file);
    while(!feof($file)) {
        $line = fgets($file);
        $line = explode("\t", $line);
        if (count($line) === 5) {
            $stmt->bindValue(':id', $line[0]);
            $stmt->bindValue(':tartalom', $line[1]);
            $stmt->bindValue(':szulo_id', $line[2]);
            $stmt->bindValue(':oldal_azonosito', $line[3]);
            $stmt->bindValue(':kattinthato', $line[4]);
            $stmt->execute();
        }
    }

    fclose($file);
    echo "Menuelemek beszúrva\n";
}

$conn = null;
