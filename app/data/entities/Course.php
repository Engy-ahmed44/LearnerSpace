<?php

namespace App\DB\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\GeneratedValue;

#[ORM\Entity(repositoryClass: 'App\DB\Repository\CourseRepository')]
#[ORM\Table(name: 'courses')]
class Course
{
	#[ORM\Id]
	#[ORM\GeneratedValue]
	#[ORM\Column(type: "integer")]
	private int $id;

	#[ORM\Column(type: "string", length: 255)]
	private string $title;

	#[ORM\ManyToOne(targetEntity: Tutor::class, inversedBy: "courses")]
	#[ORM\JoinColumn(nullable: false)]
	private $tutor;

	#[ORM\ManyToMany(targetEntity: Student::class, mappedBy: "enrolledCourses")]
	private $students;

	#[ORM\OneToMany(mappedBy: "course", targetEntity: CourseContent::class)]
	private $content;

	public function __construct()
	{
		$this->students = new ArrayCollection();
		$this->content = new ArrayCollection();
	}
}

#[ORM\Table(name: 'courses_contents')]
#[ORM\Entity]
class CourseContent
{
	#[ORM\Id]
	#[ORM\GeneratedValue]
	#[ORM\Column(type: "integer")]
	private int $id;

	#[ORM\Column(type: "string", length: 255)]
	private string $title;

	#[ORM\Column(type: "text")]
	private string $content;

	#[ORM\ManyToOne(targetEntity: Course::class, inversedBy: "content")]
	#[ORM\JoinColumn(nullable: false)]
	private $course;

	// Getters and setters...
}
