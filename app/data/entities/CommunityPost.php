<?php

namespace App\DB\Entity;

use App\DB\Entity\User;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'community_posts')]
#[ORM\Entity(repositoryClass: 'App\DB\Repository\CommunityPostRepository')]
class CommunityPost
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string', length: 255)]
    private string $title;

    #[ORM\Column(type: 'text')]
    private string $content;

    #[ORM\ManyToOne(targetEntity: 'User')]
    #[ORM\JoinColumn(name: 'author_id', referencedColumnName: 'id')]
    private User $author;

    #[ORM\Column(type: 'datetime')]
    private \DateTime $createdAt;

    // Constructor
    public function __construct(string $title, string $content, User $author)
    {
        $this->title = $title;
        $this->content = $content;
        $this->author = $author;
        $this->createdAt = new \DateTime(); // Set current datetime as the creation time
    }

    // Getters
    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getAuthor(): User
    {
        return $this->author;
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }
}
