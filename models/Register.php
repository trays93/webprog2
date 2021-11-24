<?php

class Register
{
    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $firstName;

    /**
     * @var string
     */
    private $lastName;

    /**
     * @var string
     */
    private $password;

    private int $role = 2;

    public function __construct(string $email, string $firstName, string $lastName, string $password)
    {
        $this->setEmail($email)
            ->setFirstName($firstName)
            ->setLastName($lastName)
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

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;
        return $this;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;
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

    public function getRole(): int
    {
        return $this->role;
    }

    public function setRole(int $role): self
    {
        $this->role = $role;
        return $this;
    }
}
