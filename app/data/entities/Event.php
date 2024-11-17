<?php

namespace App\DB\Entity;

use App\DB\Entity\Course;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'events')]
#[ORM\Entity(repositoryClass: 'App\DB\Repository\EventRepository')]
class Event
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private int $id;

    #[ORM\Column(type: "string", length: 255)]
    private string $name;

    #[ORM\Column(type: "datetime")]
    private \DateTime $date;

    // Constructor to initialize the object
    public function __construct(string $name, \DateTime $date)
    {
        $this->name = $name;
        $this->date = $date;
    }

    // Getter for id
    public function getId(): int
    {
        return $this->id;
    }

    // Getter for name
    public function getName(): string
    {
        return $this->name;
    }

    // Getter for date
    public function getDate(): \DateTime
    {
        return $this->date;
    }
}
