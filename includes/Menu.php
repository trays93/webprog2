<?php

class Menu{

    private int $id;
    private string $comment;
    private int $parentId;
    private string $pagePath;
    private bool $click;

    public function __construct(int $id, string $comment, int $parentId, 
                                string $pagePath, bool $click,)
    {
        $this->id           = $id;
        $this->comment      = $comment;
        $this->parentId    = $parentId;
        $this->pagePath    = $pagePath;
        $this->click        = $click;
    }


    public function getId(): int
    {
        return $this->id;
    }

    public function getComment(): string
    {
        return $this->comment;
    }

    public function getParentId(): int
    {
        return $this->parentId;
    }

    public function getPagePath(): string
    {
        return $this->pagePath;
    }

    public function getClick(): bool
    {
        return $this->click;
    }
}