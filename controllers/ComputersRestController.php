<?php

class ComputersRestController
{
    private PDO $connection;
    private static $selectComputers = 'SELECT `id`, `hely`, `tipus`, `ipcim` FROM `gep`';
    private static $selectComputer = 'SELECT `id`, `hely`, `tipus`, `ipcim` FROM `gep` WHERE `id` = :id';
    private static $selectInstallationsWithSoftware = 'SELECT `telepites`.`id`, `gepid`, `szoftverid`, `verzio`, `datum`, `nev`, `kategoria` FROM `telepites` LEFT JOIN `szoftver` ON `telepites`.`szoftverid` = `szoftver`.`id` WHERE `gepid` = :id';
    private static $insertComputer = 'INSERT INTO `gep`(`hely`, `tipus`, `ipcim`) VALUES (:hely, :tipus, :ipcim)';
    private static $updateComputer = 'UPDATE `gep` SET `hely` = :hely,`tipus` = :tipus,`ipcim` = :ipcim WHERE `id` = :id';
    private static $deleteComputer = 'DELETE FROM `gep` WHERE `id` = :id';

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function getComputersAction(Request $request)
    {
        $stmt = $this->connection->prepare(ComputersRestController::$selectComputers);
        $stmt->execute();
        $gepek = [];

        foreach ($stmt->fetchAll() as $data) {
            $gep = new Gep($data['hely'], $data['tipus'], $data['ipcim'], $data['id']);
            $gepek[] = $gep->toArray();
        }

        echo json_encode($gepek);
        return;
    }

    public function getComputerAction(Request $request, int $id)
    {
        $stmt = $this->connection->prepare(ComputersRestController::$selectComputer);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        $gep = $this->getComputerById($id);

        if ($gep === null) {
            http_response_code(404);
            
            echo json_encode([
                'error' => 'A kért gép nem létezik.',
            ]);
            return;
        }

        $stmt = $this->connection->prepare(ComputersRestController::$selectInstallationsWithSoftware);
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        foreach ($stmt->fetchAll() as $data) {
            $szoftver = new Szoftver($data['nev'], $data['kategoria'], $data['szoftverid']);
            $datum = $data['datum'] === null ? null : new DateTime($data['datum']);
            $telepites = new Telepites(
                $szoftver, $data['verzio'], $datum, $data['id']);
            $gep->addTelepites($telepites);
        }

        echo json_encode($gep->toArray());
        return;
    }

    public function insertComputerAction(Request $request)
    {
        $hely = $request->get('hely');
        $tipus = $request->get('tipus');
        $ipcim = $request->get('ipcim');

        $errors = $this->validateData($hely, $tipus, $ipcim);
        if ($errors !== []) {
            http_response_code(400);
            echo json_encode($errors);
            return;
        }

        $stmt = $this->connection->prepare(ComputersRestController::$insertComputer);
        $stmt->bindValue(':hely', $hely);
        $stmt->bindValue(':tipus', $tipus);
        $stmt->bindValue(':ipcim', $ipcim);
        $stmt->execute();

        $insertedMachine = new Gep($hely, $tipus, $ipcim, $this->connection->lastInsertId());
        echo json_encode($insertedMachine->toArray());
        return;
    }

    public function updateComputerAction(Request $request, int $id)
    {
        $hely = $request->get('hely');
        $tipus = $request->get('tipus');
        $ipcim = $request->get('ipcim');

        $errors = $this->validateData($hely, $tipus, $ipcim);
        if ($errors !== []) {
            http_response_code(400);
            echo json_encode($errors);
            return;
        }

        if ($this->getComputerById($id) === null) {
            http_response_code(404);
            return json_encode([
                'error' => 'A kért gép nem létezik.',
            ]);
        }

        $stmt = $this->connection->prepare(ComputersRestController::$updateComputer);
        $stmt->bindValue(':id', $id);
        $stmt->bindValue(':hely', $hely);
        $stmt->bindValue(':tipus', $tipus);
        $stmt->bindValue(':ipcim', $ipcim);
        $stmt->execute();

        $updatedMachine = new Gep($hely, $tipus, $ipcim, $id);
        echo json_encode($updatedMachine->toArray());
        return;
    }

    public function deleteComputerAction(Request $request, int $id)
    {
        if ($this->getComputerById($id) === null) {
            http_response_code(404);
            echo json_encode([
                'error' => 'A kért gép nem létezik.',
            ]);
            return;
        }

        $stmt = $this->connection->prepare(ComputersRestController::$deleteComputer);
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        http_response_code(204);
        return;
    }

    private function getComputerById($id): ?Gep
    {
        $stmt = $this->connection->prepare(ComputersRestController::$selectComputer);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        $gep = null;

        if ($stmt->rowCount() == 1) {
            $data = $stmt->fetch();
            $gep = new Gep($data['hely'], $data['tipus'], $data['ipcim'], $data['id']);
        }

        return $gep;
    }

    private function validateData(?string $hely, ?string $tipus, ?string $ipcim)
    {
        $errors = [];

        if ($hely === null || $hely === '') {
            $errors['hely'] = 'A hely kötelező';
        }

        if ($tipus === null || $tipus === '') {
            $errors['tipus'] = 'A típus kötelező';
        }

        if ($ipcim === null || $ipcim === '') {
            $errors['ipcim'] = 'Az IP cím kötelező';
        }

        return $errors;
    }
}
