<?php

class News
{
    
    //Tagváltozók
    /**
     * @var string
     */
    private $user_name;

    /**
     * @var DateTime
     */
    private $date;

        /**
     * @var string
     */
    private $comment;

            /**
     * @var int
     */
    private $user_id;

    //Konstruktor
    public function __construct(int $user_id, string $user_name, DateTime $date, string $comment)
    {
        $this->setUserId($user_id)
            ->setUserName($user_name)
            ->setDate($date)
            ->setComment($comment);
            
    }

    //Getterek és Setterek
    public function getUserName(): string
    {
        return $this->user_name;
    }

    public function setUserName(string $user_name): self
    {
        $this->user_name = $user_name;
        return $this;
    }


    public function getDate(): DateTime
    {
        return $this->date;
    }

    public function setDate(DateTime $date): self
    {
        $this->date = $date;
        return $this;
    }


    public function getComment(): string
    {
        return $this->comment;
    }

    public function setComment(string $comment): self
    {
        $this->comment = $comment;
        return $this;
    }


    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function setUserId(int $user_id): self
    {
        $this->user_id = $user_id;
        return $this;
    }
}