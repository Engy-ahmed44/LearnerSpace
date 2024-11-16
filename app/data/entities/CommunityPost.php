<?php

namespace App\Entity;

use App\DB\Entity\User;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'community_posts')]
#[ORM\Entity]
class CommunityPost
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private int $id;

    #[ORM\Column(type: "text")]
    private string $content;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $author;

    #[ORM\Column(type: "datetime")]
    private \DateTimeInterface $createdAt;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    // Getters and setters...
}
