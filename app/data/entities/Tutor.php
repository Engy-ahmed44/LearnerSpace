<?php

namespace App\DB\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\GeneratedValue;

#[ORM\Table(name: 'tutors')]
#[ORM\Entity(repositoryClass: 'App\DB\Repository\TutorRepository')]
class Tutor extends User
{

    #[ORM\OneToMany(mappedBy: "tutor", targetEntity: Course::class)]
    private $courses;

    public function __construct()
    {
        parent::__construct();
        $this->courses = new ArrayCollection();
    }

    /**
     * Get the courses associated with this tutor.
     *
     * @return Collection|Course[]
     */
    public function getCourses(): Collection
    {
        return $this->courses;
    }
}
