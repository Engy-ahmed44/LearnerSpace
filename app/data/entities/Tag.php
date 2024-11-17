<?php

namespace App\DB\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\GeneratedValue;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity(repositoryClass: 'App\DB\Repository\TagRepository')]
#[ORM\Table(name: 'tags')]
class Tag
{
	#[Id]
	#[GeneratedValue(strategy: 'AUTO')]
	#[Column(type: 'integer')]
	private int $id;

	#[Column(type: 'string', length: 100)]
	private string $name;

	#[Column(type: 'datetime')]
	private \DateTime $created_at;

	#[ORM\ManyToMany(targetEntity: Course::class)]
	private Collection $courses;

	#[ORM\ManyToMany(targetEntity: Blog::class)]
	private Collection $blogs;

	public function __construct(string $name)
	{
		$this->name = $name;
		$this->created_at = new \DateTime();
		$this->courses = new ArrayCollection();
	}

	// Getters
	//
	public function getId(): int
	{
		return $this->id;
	}

	public function getCreatedAt(): \DateTime
	{
		return $this->created_at;
	}

	public function getName(): string
	{
		return $this->name;
	}

	public function getCourses(): Collection
	{
		return $this->courses;
	}
	public function getBlog(): Collection
	{
		return $this->blogs;
	}
}
