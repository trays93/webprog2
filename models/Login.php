<?php

class Login
{
    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $password;
    
    public function __construct(string $email, string $password)
    {
        $this->setEmail($email)
            ->setPassword($password);
    }


    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = sha1($password);
        return $this;
    }
}
