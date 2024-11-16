<?php

namespace App\DB\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\GeneratedValue;

#[ORM\Table(name: 'students')]
#[ORM\Entity]
class Student extends User
{

    #[ORM\ManyToMany(targetEntity: Course::class, inversedBy: "students")]
    private $enrolledCourses;

    public function __construct()
    {
        $this->enrolledCourses = new ArrayCollection();
    }
}
