<?php

class PdfController
{
    
    private PDO $connection;
    private $selectRooms = 'SELECT hely, id FROM gep GROUP BY hely ORDER BY hely';
    private $selectIP = 'SELECT `ipcim`, `id` FROM `gep` WHERE :hely = `hely`';
    private $selectSoftware = 'SELECT sz.nev, sz.id
                               FROM (szoftver AS sz 
                                    INNER JOIN telepites AS t ON (sz.id=t.szoftverid)) 
                                    INNER JOIN gep AS g ON (g.id=t.gepid) 
                               WHERE g.id = :gid
                               ORDER BY sz.nev';
    private $selectAll = 'SELECT g.hely, g.tipus, g.ipcim, 
                                 sz.nev, sz.kategoria, t.verzio, t.datum
                          FROM (szoftver AS sz 
                          INNER JOIN telepites AS t ON (sz.id=t.szoftverid)) 
                          INNER JOIN gep AS g ON (g.id=t.gepid)
                          WHERE g.id = :gid &&
                                sz.id = :sid';

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    
    public function indexAction()
    {
        return new View('pdf', 'index');

    }

    public function createAction()
    {

        return new View('pdf', 'create');

    }

    public function getRoomsAction() {
        $result = array("lista" => array());
            try {
                $stmt = $this->connection->prepare($this->selectRooms);
                $stmt->execute();
            
                while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $result["lista"][] = array("data" => $row['hely'], "id" => $row['id']);
                }

            
                echo json_encode($result);
                return;
            }
            catch(PDOException $e) {
            }
            echo json_encode($result);
        }

    public function getIpsAction() {
        $result = array("lista" => array());
        try {
            $stmt = $this->connection->prepare($this->selectIP);
            $stmt->bindValue(":hely", $_POST["hely"]);
            $stmt->execute();

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result["lista"][] = array("id" => $row['id'], "data" => $row['ipcim']);
        }

        echo json_encode($result);
        return;
        }
        catch(PDOException $e) {
        }
        echo json_encode($result);
    }

    public function getSoftwaresAction() {
        $result = array("lista" => array());
            try {
                $stmt = $this->connection->prepare($this->selectSoftware);
                $stmt->bindValue(':gid', $_POST['gid']);
                $stmt->execute();

                while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $result["lista"][] = array("data" => $row['nev'], "id" => $row['id']);
                }
                echo json_encode($result);
                return;
            }
                catch(PDOException $e) {
                }
                echo json_encode($result);
    }

    public function getAllAction() {
        $result = array("hely" => "", "tipus" => "", "ipcim" => "", "nev" => "", 
                                    "kategoria" => "", "verzio" => "", "datum" => "");
                  try {
                    $stmt = $this->connection->prepare($this->selectAll);
                    $stmt->bindValue(':gid', $_POST['gid']);
                    $stmt->bindValue(':sid', $_POST['sid']);
                    $stmt->execute();

                    if($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $result = array("hely" => $row['hely'], "tipus" => $row['tipus'], 
                                          "ipcim" => $row['ipcim'], "nev" => $row['nev'], 
                                          "kategoria" => $row['kategoria'], 
                                          "verzio" => $row['verzio'], "datum" => $row['datum']);
                        $query = $this->toPdfAction($result);
                        echo json_encode(["data" => $query]);
                        return;
                    }

                  }
                  catch(PDOException $e) {
                  }
                  echo json_encode($result);
    }

    private function toPdfAction(array $data) : string {
        $result = '<table border="1" cellspacing="2" celpadding="20" style="width:80%">
            <tr>
                <td>Hely</td>
                <td>'.$data['hely'].'</td>
            </tr>
            <tr>
                <td>Típus</td>
                <td>'.$data['tipus'].'</td>
            </tr>
            <tr>
                <td>IP-cím</td>
                <td>'.$data['ipcim'].'</td>
            </tr>
            <tr>
                <td>Név</td>
                <td>'.$data['nev'].'</td>
            </tr>
            <tr>
                <td>Kategória</td>
                <td>'.$data['kategoria'].'</td>
            </tr>
            <tr>
                <td>Verzió</td>
                <td>'.$data['verzio'].'</td>
            </tr>
            <tr>
                <td>Dátum</td>
                <td>'.$data['datum'].'</td>
            </tr>
        </table>';

        return $result;
    }

}
