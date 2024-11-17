<?php

namespace App\DB\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'students')]
#[ORM\Entity]
class Student extends User
{
    #[ORM\ManyToMany(targetEntity: Course::class, inversedBy: "students")]
    private Collection $enrolledCourses;

    public function __construct()
    {
        $this->enrolledCourses = new ArrayCollection();
    }

    /**
     * Get all enrolled courses.
     *
     * @return Collection|Course[]
     */
    public function getEnrolledCourses(): Collection
    {
        return $this->enrolledCourses;
    }


    /**
     * Enroll in a new course.
     *
     * @param Course $course
     */
    public function enrollInCourse(Course $course): void
    {
        if (!$this->enrolledCourses->contains($course)) {
            $this->enrolledCourses->add($course);
            $course->addStudent($this); // Ensure the inverse side is updated if mapped
        }
    }

    /**
     * Remove an enrolled course.
     *
     * @param Course $course
     */
    public function removeEnrolledCourse(Course $course): void
    {
        if ($this->enrolledCourses->contains($course)) {
            $this->enrolledCourses->removeElement($course);
            $course->removeStudent($this); // Ensure the inverse side is updated if mapped
        }
    }
}
