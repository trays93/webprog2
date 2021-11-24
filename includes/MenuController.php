<?php
class MenuController
{
    private PDO $connection;
    private $selectItem = 'SELECT id, tartalom, szulo_id, oldal_azonosito, kattinthato, jogosultsag FROM oldalak WHERE szulo_id = :id';
    

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function getItem(int $id) : array {
        $result = [];
            try {
                $stmt = $this->connection->prepare($this->selectItem);
                $stmt->bindValue(":id", $id);
                $stmt->execute();
            
                while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $new = new Menu($row["id"], $row["tartalom"], $row["szulo_id"], 
                                    $row["oldal_azonosito"], $row["kattinthato"], $row['jogosultsag']);
                    $result[] = $new;
                }

                return $result;
            }
            catch(PDOException $e) {
            }
            return $result;
    }
}