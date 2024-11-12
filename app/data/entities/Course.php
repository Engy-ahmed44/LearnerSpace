<?php

namespace App\DB\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\GeneratedValue;

#[ORM\Entity(repositoryClass: 'App\DB\Repository\CourseRepository')]
#[ORM\Table(name: 'courses')]
class Course
{
	#[Id]
	#[GeneratedValue(strategy: 'AUTO')]
	#[Column(type: 'integer')]
	private int $id;

	#[Column(type: 'string', length: 100)]
	private string $name;

	#[Column(type: 'string', length: 512, nullable: true)]
	private ?string $description;

	#[Column(type: 'datetime')]
	private \DateTime $created_at;

	#[Column(type: 'datetime')]
	private \DateTime $updated_at;

	// TBD
	// #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'reportedBugs')]
	// private User $instructor;

	public function __construct(string $name, string $description, User $instructor)
	{
		$this->name = $name;
		$this->description = $description;
		// $this->instructor = $instructor;
		$this->created_at = new \DateTime();
		$this->updated_at = new \DateTime();
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

	public function getUpdatedAt(): \DateTime
	{
		return $this->updated_at;
	}

	public function getName(): string
	{
		return $this->name;
	}

	public function getDescription(): string
	{
		return $this->description;
	}

	// TBD
	// public function getInstructor(): User
	// {
	// 	return $this->instructor;
	// }

	// Setters
	//
	public function setUpdatedAt(): void
	{
		$this->updated_at = new \DateTime();
	}

	public function setName(string $name): void
	{
		$this->name = $name;
		$this->setUpdatedAt();
	}

	public function setDescription(string $description): void
	{
		$this->description = $description;
	}

	// TBD
	// public function setInstructor(User $instructor): void
	// {
	// 	$this->instructor = $instructor;
	// }
}
