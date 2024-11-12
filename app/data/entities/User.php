<?php

namespace App\DB\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\GeneratedValue;

#[ORM\Entity(repositoryClass: 'App\DB\Repository\UserRepository')]
#[ORM\Table(name: 'users')]
class User
{
    #[Id]
    #[GeneratedValue(strategy: 'AUTO')]
    #[Column(type: 'integer')]
    private int $id;

    #[Column(type: 'string', length: 255, unique: true)]
    private string $email;

    #[Column(type: 'string', length: 255)]
    private string $password;

    #[Column(type: 'string', length: 100, nullable: true)]
    private ?string $first_name;

    #[Column(type: 'string', length: 100, nullable: true)]
    private ?string $last_name;

    #[Column(type: 'datetime')]
    private \DateTime $created_at;

    #[Column(type: 'datetime')]
    private \DateTime $updated_at;

    public function __construct(string $email, string $password)
    {
        $this->email = $email;
        $this->password = $password;
        $this->created_at = new \DateTime();
        $this->updated_at = new \DateTime();
    }

    // Getters and setters

    public function getId(): int
    {
        return $this->id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function setFirstName(?string $first_name): void
    {
        $this->first_name = $first_name;
    }

    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    public function setLastName(?string $last_name): void
    {
        $this->last_name = $last_name;
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTime $created_at): void
    {
        $this->created_at = $created_at;
    }

    public function getUpdatedAt(): \DateTime
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTime $updated_at): void
    {
        $this->updated_at = $updated_at;
    }
}
