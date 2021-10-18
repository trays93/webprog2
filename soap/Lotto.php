<?php

class Lotto
{
    /**
     * @var PDO
     */
    private $conn;

    public function __construct()
    {
        $this->conn = Database::getConnection();
    }

    public function __destruct()
    {
        $this->conn = null;
    }

    /**
     * Lekérdezi a húzást azonosító alapján.
     *
     * @param integer $id
     * @return Huzas
     */
    public function getHuzas(int $id = 0): ?Huzas
    {
        $huzas = null;

        try {
            if ($id === 0) {
                $stmt = $this->conn->prepare("SELECT MAX(`huzas`.`id`) AS 'id' FROM `huzas`;");
                $stmt->execute();
                $id = $stmt->fetchColumn();
            }

            $stmt = $this->conn->prepare("SELECT `huzas`.`id`, `huzas`.`ev`, `huzas`.`het` FROM `huzas` WHERE `huzas`.`id` = :id;");
            $stmt->bindValue(':id', $id);
            $stmt->execute();

            if ($stmt->rowCount() === 1) {
                $result = $stmt->fetch();
                $huzas = new Huzas($result['id'], $result['ev'], $result['het']);
                $huzas->setSzamok($this->getHuzasSzamok($huzas->id))
                    ->setTalalatok($this->getHuzasTalalatok($huzas->id))
                    ->setMegelozoHuzasId($this->getElozoHuzasId($huzas->id))
                    ->setKovetkezoHuzasId($this->getKovetkezoHuzasId($huzas->id))
                    ->setEvek($this->getEvek());

                return $huzas;
            } else {
                return $huzas;
            }

        } catch (PDOException $e) {
            return $huzas;
        }
    }

    /**
     * Az adott húzáshoz kérdezi le a húzott számokat
     *
     * @param integer $id
     * @return int[]
     */
    private function getHuzasSzamok(int $id): array
    {
        $szamok = [];

        $stmt = $this->conn->prepare("SELECT `huzott`.`szam` FROM `huzott` WHERE `huzott`.`huzas_id` = :id ORDER BY `huzott`.`szam` ASC;");
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        foreach ($stmt->fetchAll() as $szam) {
            $szamok[] = $szam[0];
        }

        return $szamok;
    }

    /**
     * Az adott húzás találatait kérdezi le.
     *
     * @param integer $id
     * @return Talalat[]
     */
    private function getHuzasTalalatok(int $id): array
    {
        $talalatok = [];

        $stmt = $this->conn->prepare("SELECT `nyeremeny`.`talalat`, `nyeremeny`.`darab`, `nyeremeny`.`ertek` FROM `nyeremeny` WHERE `nyeremeny`.`huzas_id` = :id ORDER BY `nyeremeny`.`talalat`;");
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        foreach ($stmt->fetchAll() as $row) {
            $talalatok[] = new Talalat($row['talalat'], $row['darab'], $row['ertek']);
        }

        return $talalatok;
    }

    /**
     * Lekérdezi az adatbázisból az adott húzást követő húzás azonosítóját.
     * 0-val tér vissza ha nem talált ilyet.
     *
     * @param integer $id
     * @return integer
     */
    private function getKovetkezoHuzasId(int $id): int
    {
        $kovetkezoId = 0;

        $stmt = $this->conn->prepare("SELECT `huzas`.`id`, `huzas`.`ev`, `huzas`.`het` FROM `huzas` WHERE `huzas`.`id` = :id;");
        $stmt->bindValue(':id', ++$id);
        $stmt->execute();

        if ($stmt->rowCount() === 1) {
            $result = $stmt->fetch();
            $kovetkezoId = $result['id'];
            return $kovetkezoId;
        } else {
            return $kovetkezoId;
        }
    }

    /**
     * Lekérdezi az adatbázisból az adott húzást megelőző húzás azonosítóját.
     * 0-val tér vissza ha nem talált ilyet.
     *
     * @param integer $id
     * @return integer
     */
    private function getElozoHuzasId(int $id): int
    {
        $kovetkezoId = 0;

        $stmt = $this->conn->prepare("SELECT `huzas`.`id`, `huzas`.`ev`, `huzas`.`het` FROM `huzas` WHERE `huzas`.`id` = :id;");
        $stmt->bindValue(':id', --$id);
        $stmt->execute();

        if ($stmt->rowCount() === 1) {
            $result = $stmt->fetch();
            $kovetkezoId = $result['id'];
            return $kovetkezoId;
        } else {
            return $kovetkezoId;
        }
    }

    /**
     * Az év kiválasztásához kérdezi le a húzás éveit
     *
     * @return int[]
     */
    private function getEvek(): array
    {   
        $evek = [];
        try {
            
            
            $stmt = $this->conn->prepare("SELECT `huzas`.`ev`, COUNT(`huzas`.`id`) AS 'countYears' FROM `huzas` GROUP BY `huzas`.`ev` ORDER BY `huzas`.`ev` DESC;");
            $stmt->execute();

            foreach ($stmt->fetchAll() as $ev) {
                $evek[] = $ev[0];
            }

            return $evek;

        } catch (PDOException $e) {
        return $evek;
        }
    }

    /**
     * Év és dátum alapján vissza adja az id-t
     *
     * @param integer $year
     * @param integer $weak
     * @return int
     */
    public function getIdFromYW(int $year, int $week): int
    {
        
        $id = -1;
        try {
            
            
            $stmt = $this->conn->prepare("SELECT `huzas`.`id` FROM `huzas` WHERE `huzas`.`ev` = :year AND `huzas`.`het` = :week;");
            $stmt->bindValue(':year', $year);
            $stmt->bindValue(':week', $week);
            $stmt->execute();

            if ($stmt->rowCount() === 1) {
                $id = $stmt->fetchColumn();
            }

            return $id;

        } catch (PDOException $e) {
        return $id;
        }
    }
}
