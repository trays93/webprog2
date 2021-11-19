<?php

class Telepites
{
    private int $id;
    private Szoftver $szoftver;
    private string $verzio;
    private ?DateTime $datum;

    public function __construct(
        Szoftver $szoftver, string $verzio, DateTime $datum = null, int $id = 0)
    {
        $this->id       = $id;
        $this->szoftver = $szoftver;
        $this->verzio   = $verzio;
        $this->datum    = $datum;
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

    public function getSzoftver(): Szoftver
    {
        return $this->szoftver;
    }

    public function setSzoftver($szoftver): self
    {
        $this->szoftver = $szoftver;
        return $this;
    }

    public function getVerzio(): string
    {
        return $this->verzio;
    }

    public function setVerzio(string $verzio): self
    {
        $this->verzio = $verzio;
        return $this;
    }

    public function getDatum(): ?DateTime
    {
        return $this->datum;
    }

    public function setDatum(DateTime $datum): self
    {
        $this->datum = $datum;
        return $this;
    }

    public function toArray(): array
    {
        return [
            'id'            => $this->id,
            'szoftver'      => $this->szoftver->toArray(),
            'verzio'        => $this->verzio,
            'datum'         => $this->datum !== null  ? $this->getDatum()->format('Y.m.d') : '-',
        ];
    }
}
