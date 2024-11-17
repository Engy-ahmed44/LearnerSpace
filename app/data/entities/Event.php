<?php

namespace App\Entity;

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
    private \DateTimeInterface $date;

    #[ORM\ManyToOne(targetEntity: Course::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $course;

    // Getters and setters...
}
