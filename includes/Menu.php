<?php

class Menu{

    private int $id;
    private string $comment;
    private int $parentId;
    private string $pagePath;
    private bool $click;
    private int $permission;

    public function __construct(int $id, string $comment, int $parentId, 
                                string $pagePath, bool $click, int $permission)
    {
        $this->id           = $id;
        $this->comment      = $comment;
        $this->parentId     = $parentId;
        $this->pagePath     = $pagePath;
        $this->click        = $click;
        $this->permission   = $permission;
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

    public function getPermission(): int
    {
        return $this->permission;
    }
}