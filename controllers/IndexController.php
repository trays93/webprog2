<?php

class IndexController
{
    public function indexAction()
    {
        return new View('index', 'index', ['egy', 'kettő']);
    }

    public function computersAction()
    {
        return new View('index', 'computers', []);
    }

    public function chartAction()
    {
        $data = [];
        try {
            $conn = Database::getConnection();
            $stmt = $conn->prepare("SELECT sz.nev, COUNT(*) as countid
                                    FROM szoftver AS sz INNER JOIN telepites AS t ON (sz.id=t.szoftverid)
                                    GROUP BY sz.nev
                                    ORDER BY countid DESC;");
            $stmt->execute();

            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $data[] = array("nev" => $row['nev'], "count" => $row['countid']);
            }

            return new View('index', 'chart', $data);

        } catch (PDOException $e) {
            return new View('error', 'error', [
                'error' => $e->getMessage()
            ]);
        } finally {
            $conn = null;
        }
    }

}
