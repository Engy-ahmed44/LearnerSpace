<?php

namespace App\DB\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'courses')]
#[ORM\Entity(repositoryClass: 'App\DB\Repository\CourseRepository')]
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
	private Tutor $tutor;

	#[ORM\ManyToMany(targetEntity: Student::class, mappedBy: "enrolledCourses")]
	private Collection $students;

	#[ORM\OneToMany(mappedBy: "course", targetEntity: CourseContent::class, cascade: ['persist', 'remove'], orphanRemoval: true)]
	private Collection $content;

	public function __construct()
	{
		$this->students = new ArrayCollection();
		$this->content = new ArrayCollection();
	}

	/**
	 * Get all course content.
	 *
	 * @return Collection|CourseContent[]
	 */
	public function getContent(): Collection
	{
		return $this->content;
	}

	/**
	 * Add a content item to the course.
	 *
	 * @param CourseContent $courseContent
	 * @return self
	 */
	public function addContent(CourseContent $courseContent): self
	{
		if (!$this->content->contains($courseContent)) {
			$this->content[] = $courseContent;
			$courseContent->setCourse($this); // Maintain bidirectional relationship
		}

		return $this;
	}

	/**
	 * Remove a content item from the course.
	 *
	 * @param CourseContent $courseContent
	 * @return self
	 */
	public function removeContent(CourseContent $courseContent): self
	{
		if ($this->content->removeElement($courseContent)) {
			// Ensure content is deleted completely
			$courseContent->delete(); // Custom method to handle invalidation
		}

		return $this;
	}

	public function addStudent(Student $student): void
	{
		// Check if the student is already enrolled to avoid duplicates
		if (!$this->students->contains($student)) {
			// Add student to the course's collection of students
			$this->students->add($student);

			// Also, add this course to the student's enrolled courses (bidirectional relation)
			$student->enrollInCourse($this);
		}
	}

	/**
	 * Remove an enrolled course.
	 *
	 * @param Student $course
	 */
	public function removeStudent(Student $student): void
	{
		// Check if the student is already enrolled to avoid duplicates
		if (!$this->students->contains($student)) {
			$this->content->removeElement($student);
			$student->removeEnrolledCourse($this);
		}
	}
}

// MARK: - Course Content

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
	private Course $course;

	public function __construct(string $title, string $content, Course $course)
	{
		$this->title = $title;
		$this->content = $content;
		$this->setCourse($course); // Automatically associate with a course
	}

	/**
	 * Get the ID of the course content.
	 *
	 * @return int
	 */
	public function getId(): int
	{
		return $this->id;
	}

	/**
	 * Get the title of the course content.
	 *
	 * @return string
	 */
	public function getTitle(): string
	{
		return $this->title;
	}

	/**
	 * Set the title of the course content.
	 *
	 * @param string $title
	 * @return self
	 */
	public function setTitle(string $title): self
	{
		$this->title = $title;
		return $this;
	}

	/**
	 * Get the content.
	 *
	 * @return string
	 */
	public function getContent(): string
	{
		return $this->content;
	}

	/**
	 * Set the content.
	 *
	 * @param string $content
	 * @return self
	 */
	public function setContent(string $content): self
	{
		$this->content = $content;
		return $this;
	}

	/**
	 * Get the associated course.
	 *
	 * @return Course
	 */
	public function getCourse(): Course
	{
		return $this->course;
	}

	/**
	 * Set the associated course.
	 *
	 * @param Course $course
	 * @return self
	 */
	public function setCourse(Course $course): self
	{
		$this->course = $course;

		// Maintain bidirectional relationship
		if (!$course->getContent()->contains($this)) {
			$course->addContent($this);
		}

		return $this;
	}

	/**
	 * Handle deletion of this course content.
	 * 
	 * This should only be called by the owning course.
	 */
	public function delete(): void
	{
		// Additional logic for cleanup can be added here if needed.
	}
}
