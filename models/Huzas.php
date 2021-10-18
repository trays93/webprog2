<?php

class Huzas
{
    /**
     * @var int
     */
    public $id;
    
    /**
     * @var int
     */
    public $ev;
    
    /**
     * @var int
     */
    public $het;

    /**
     * @var int[]
     */
    public $szamok;

    /**
     * @var int
     */
    public $kovetkezoHuzasId;
    
    /**
     * @var int
     */
    public $megelozoHuzasId;

    /**
     * A húzáshoz tartozó találatok
     *
     * @var Talalat[]
     */
    public $talalatok;

    /**
     * Az összes olyan év, amiben volt húzás
     * 
     * @var int[]
     */
    public $evek;

    /**
     * @param integer $id
     * @param integer $ev
     * @param integer $het
     */
    public function __construct(int $id, int $ev, int $het)
    {
        $this->id               = $id;
        $this->ev               = $ev;
        $this->het              = $het;
        $this->szamok           = [];
        $this->talalatok        = [];
        $this->kovetkezoHuzasId = 0;
        $this->megelozoHuzasId  = 0;
        $this->evek             = [];
    }

    /**
     * A húzott számokat állítja be.
     *
     * @param int[] $szamok
     * @return self
     */
    public function setSzamok(array $szamok): self
    {
        $this->szamok = $szamok;
        return $this;
    }

        /**
     * A lekérdezett éveket állítja be
     *
     * @param int[] $evek
     * @return self
     */
    public function setEvek(array $evek): self
    {
        $this->evek = $evek;
        return $this;
    }

    /**
     * Undocumented function
     *
     * @param array $talalatok
     * @return self
     */
    public function setTalalatok(array $talalatok): self
    {
        $this->talalatok = $talalatok;
        return $this;
    }

    public function setKovetkezoHuzasId(int $id): self
    {
        $this->kovetkezoHuzasId = $id;
        return $this;
    }

    public function setMegelozoHuzasId(int $id): self
    {
        $this->megelozoHuzasId = $id;
        return $this;
    }
}
