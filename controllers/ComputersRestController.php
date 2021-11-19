<?php

class ComputersRestController
{
    private PDO $connection;
    private const SELECT_COMPUTERS = 'SELECT `id`, `hely`, `tipus`, `ipcim` FROM `gep`';
    private const SELECT_COMPUTER = 'SELECT `id`, `hely`, `tipus`, `ipcim` FROM `gep` WHERE `id` = :id';
    private const SELECT_INSTALLATIONS_WITH_SOFTWARE = 'SELECT `telepites`.`id`, `gepid`, `szoftverid`, `verzio`, `datum`, `nev`, `kategoria` FROM `telepites` LEFT JOIN `szoftver` ON `telepites`.`szoftverid` = `szoftver`.`id` WHERE `gepid` = :id';
    private const INSERT_COMPUTER = 'INSERT INTO `gep`(`hely`, `tipus`, `ipcim`) VALUES (:hely, :tipus, :ipcim)';
    private const UPDATE_COMPUTER = 'UPDATE `gep` SET `hely` = :hely,`tipus` = :tipus,`ipcim` = :ipcim WHERE `id` = :id';
    private const DELETE_COMPUTER = 'DELETE FROM `gep` WHERE `id` = :id';
    private const SELECT_LOCATIONS = 'SELECT `hely` FROM `gep` GROUP BY `hely`';
    private const SELECT_SOFTWARES = 'SELECT `id`, `nev`, `kategoria` FROM `szoftver`';

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function getComputersAction(Request $request)
    {
        $stmt = $this->connection->prepare(ComputersRestController::SELECT_COMPUTERS);
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
        $stmt = $this->connection->prepare(ComputersRestController::SELECT_COMPUTER);
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

        $stmt = $this->connection->prepare(ComputersRestController::SELECT_INSTALLATIONS_WITH_SOFTWARE);
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

        $stmt = $this->connection->prepare(ComputersRestController::INSERT_COMPUTER);
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

        $stmt = $this->connection->prepare(ComputersRestController::UPDATE_COMPUTER);
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

        $stmt = $this->connection->prepare(ComputersRestController::DELETE_COMPUTER);
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        http_response_code(204);
        return;
    }

    public function getLocationsAction(Request $request)
    {
        $stmt = $this->connection->prepare(ComputersRestController::SELECT_LOCATIONS);
        $stmt->execute();
        $locations = [];

        foreach ($stmt->fetchAll() as $data) {
            $locations[] = [
                'hely'        => $data['hely'],
            ];
        }

        echo json_encode($locations);
        return;
    }

    public function getSoftwaresAction(Request $request)
    {
        $stmt = $this->connection->prepare(ComputersRestController::SELECT_SOFTWARES);
        $stmt->execute();
        $softwares = [];

        foreach ($stmt->fetchAll() as $data) {
            $softwares[] = [
                'id'        => $data['id'],
                'nev'       => $data['nev'],
                'kategoria' => $data['kategoria'],
            ];
        }

        echo json_encode($softwares);
        return;
    }

    private function getComputerById($id): ?Gep
    {
        $stmt = $this->connection->prepare(ComputersRestController::SELECT_COMPUTER);
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
