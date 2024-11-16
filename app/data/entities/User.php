<?php

namespace App\DB\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\GeneratedValue;

#[ORM\Table(name: 'users')]
#[ORM\Entity]
#[ORM\InheritanceType('JOINED')]
#[ORM\DiscriminatorColumn(name: 'discr', type: 'string')]
#[ORM\DiscriminatorMap(['tutor' => Tutor::class, 'student' => Student::class])]
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

    public function __construct(string $email, string $password, ?string $first_name,  ?string $last_name)
    {
        $this->email = $email;
        $this->password = $password;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->created_at = new \DateTime();
        $this->updated_at = new \DateTime();
    }

    // Getters
    //
    public function getId(): int
    {
        return $this->id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->created_at;
    }

    public function getUpdatedAt(): \DateTime
    {
        return $this->updated_at;
    }

    // Setters
    //
    public function setEmail(string $email): void
    {
        $this->email = $email;
        $this->setUpdatedAt();
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
        $this->setUpdatedAt();
    }

    public function setFirstName(?string $first_name): void
    {
        $this->first_name = $first_name;
        $this->setUpdatedAt();
    }

    public function setLastName(?string $last_name): void
    {
        $this->last_name = $last_name;
        $this->setUpdatedAt();
    }

    private function setUpdatedAt(): void
    {
        $this->updated_at = new \DateTime();
    }
}
