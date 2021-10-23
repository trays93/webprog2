<?php

class StatisticsController
{
    public function indexAction()
    {
        $szamstatisztika = [];

        if (count($_POST) > 0) {
            try {
                $conn = Database::getConnection();

                $stmt = $conn->prepare("SELECT COUNT(*) AS 'szam' FROM `huzott` WHERE `szam` = :szam GROUP BY `szam`");
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                
                foreach ($_POST['szamok'] as $szam) {
                    $stmt->bindValue(':szam', $szam);
                    $stmt->execute();
                    $result = $stmt->fetch();

                    $szamstatisztika[$szam]['hanyszor'] = $result['szam'];
                }

                $stmt = $conn->prepare("SELECT `huzas`.`ev`, `huzas`.`het` FROM `huzott` LEFT JOIN `huzas` ON `huzott`.`huzas_id` = `huzas`.`id` WHERE `szam` = :szam ORDER BY `huzott`.`id` DESC LIMIT 1");
                $stmt->setFetchMode(PDO::FETCH_ASSOC);

                foreach ($_POST['szamok'] as $szam) {
                    $stmt->bindValue(':szam', $szam);
                    $stmt->execute();
                    $result = $stmt->fetch();

                    $szamstatisztika[$szam]['utoljaraHuztak'] = $result['ev'] . '. ' . $result['het'] . '. hét';
                }
            } catch (PDOException $ex) {
                return new View('error', 'error', [
                    'error' => $ex->getMessage(),
                ]);
            }
        }

        return new View('statistics', 'index', [
            'szamstatisztika' => $szamstatisztika,
        ]);
    }
}
