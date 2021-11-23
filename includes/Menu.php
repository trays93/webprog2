<?php

class Menu{

    private int $id;
    private string $comment;
    private int $parent_id;
    private string $page_path;
    private bool $click;

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

`id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Az oldal elsődleges azonosítója',
  `tartalom` text null COMMENT 'A megjelenítendő tartalom',
  `szulo_id` int(11) NULL COMMENT 'Az oldalak struktúráját határozza meg',
  `oldal_azonosito` varchar(255) NOT NULL COMMENT 'Az URL generáláshoz szükséges',
  `kattinthato` boolean NOT NULL DEFAULT false COMMENT 'Az oldal megjeleníthető-e',
  PRIMARY KEY(`id`)

}