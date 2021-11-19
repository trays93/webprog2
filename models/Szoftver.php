<?php

class Szoftver
{
    private int $id;
    private string $nev;
    private string $kategoria;

    public function __construct(string $nev = "", string $kategoria, int $id)
    {
        $this->id           = $id;
        $this->nev          = $nev;
        $this->kategoria    = $kategoria;
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

    public function getNev()
    {
        return $this->nev;
    }

    public function setNev(string $nev): self
    {
        $this->nev = $nev;
        return $this;
    }

    public function getKategoria(): string
    {
        return $this->kategoria;
    }

    public function setKategoria(string $kategoria): self
    {
        $this->kategoria = $kategoria;
        return $this;
    }

    public function toArray(): array
    {
        return [
            'id'           => $this->id,
            'nev'          => $this->nev,
            'kategoria'    => $this->kategoria,
        ];
    }
}
