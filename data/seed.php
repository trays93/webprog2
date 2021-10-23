<?php

define('SERVER_NAME', '127.0.0.1');
define('PORT', 3306);
define('DATABASE_NAME', 'beadando');
define('USER_NAME', 'root');
define('PASSWORD', '');

$conn = new PDO(
    'mysql:host=' . SERVER_NAME . ':' . PORT . ';dbname=' . DATABASE_NAME,
    USER_NAME, PASSWORD);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

echo "Csatlakozás...\n";

$file = fopen('./huzas.txt', 'r');
if ($file) {
    $stmt = $conn->prepare("INSERT INTO huzas (id, ev, het) VALUES (:id, :ev, :het)");
    
    echo "Húzások beszúrása...\n";

    while(!feof($file)) {
        $line = fgets($file);
        $line = explode("\t", $line);
        if (count($line) === 3) {
            $stmt->bindValue(':id', $line[0]);
            $stmt->bindValue(':ev', $line[1]);
            $stmt->bindValue(':het', $line[2]);
            $stmt->execute();
        }
    }

    fclose($file);
    echo "Húzások beszúrva\n";
}

$file = fopen('./huzott.txt', 'r');
if ($file) {
    $stmt = $conn->prepare("INSERT INTO huzott (id, huzas_id, szam) VALUES (:id, :huzas_id, :szam)");
    
    echo "Húzott számok beszúrása...\n";

    while(!feof($file)) {
        $line = fgets($file);
        $line = explode("\t", $line);
        if (count($line) === 3) {
            $stmt->bindValue(':id', $line[0]);
            $stmt->bindValue(':huzas_id', $line[1]);
            $stmt->bindValue(':szam', $line[2]);
            $stmt->execute();
        }
    }

    fclose($file);
    echo "Húzott számok beszúrva\n";
}

$file = fopen('./nyeremeny.txt', 'r');
if ($file) {
    $stmt = $conn->prepare("INSERT INTO nyeremeny (id, huzas_id, talalat, darab, ertek) VALUES (:id, :huzas_id, :talalat, :darab, :ertek)");
    
    echo "Nyeremények beszúrása...\n";

    while(!feof($file)) {
        $line = fgets($file);
        $line = explode("\t", $line);
        if (count($line) === 5) {
            $stmt->bindValue(':id', $line[0]);
            $stmt->bindValue(':huzas_id', $line[1]);
            $stmt->bindValue(':talalat', $line[2]);
            $stmt->bindValue(':darab', $line[3]);
            $stmt->bindValue(':ertek', $line[4]);
            $stmt->execute();
        }
    }

    fclose($file);
    echo "Nyeremények beszúrva\n";
}

$conn = null;
