<?php

class Gep
{
    private int $id;
    private string $hely;
    private string $tipus;
    private string $ipcim;
    private array $telepitesek;

    public function __construct(
        string $hely = "", string $tipus = "",
        string $ipcim = "", int $id = 0)
    {
        $this->id           = $id;
        $this->hely         = $hely;
        $this->tipus        = $tipus;
        $this->ipcim        = $ipcim;
        $this->telepitesek  = [];
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getHely(): string
    {
        return $this->hely;
    }

    public function setHely(string $hely): self
    {
        $this->hely = $hely;
        return $this;
    }
    
    public function getTipus(): string
    {
        return $this->tipus;
    }

    public function setTipus(string $tipus): self
    {
        $this->tipus = $tipus;

        return $this;
    }

    public function getIpcim(): string
    {
        return $this->ipcim;
    }

    public function setIpcim(string $ipcim): self
    {
        $this->ipcim = $ipcim;

        return $this;
    }

    public function getTelepitesek(): array
    {
        return $this->telepitesek;
    }

    public function addTelepites(Telepites $telepites): self
    {
        $this->telepitesek[] = $telepites;
        return $this;
    }

    public function toArray()
    {
        $array = [
            'id'                => $this->id,
            'hely'              => $this->hely,
            'tipus'             => $this->tipus,
            'ipcim'             => $this->ipcim,
            'telepitesek'       => [],
        ];

        foreach ($this->telepitesek as $telepites) {
            $array['telepitesek'][] = $telepites->toArray();
        }

        return $array;
    }
}
