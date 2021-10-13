<?php

class Talalat
{
    /**
     * @var int
     */
    public $talalat;

    /**
     * @var int
     */
    public $darab;
    
    /**
     * @var int
     */
    public $ertek;

    /**
     * @param integer $talalat
     * @param integer $darab
     * @param integer $ertek
     */
    public function __construct(int $talalat, int $darab, int $ertek)
    {
        $this->talalat  = $talalat;
        $this->darab    = $darab;
        $this->ertek    = $ertek;
    }
}
