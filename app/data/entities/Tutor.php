<?php

namespace App\DB\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\GeneratedValue;

#[ORM\Table(name: 'tutors')]
#[ORM\Entity]
class Tutor extends User
{

    #[ORM\OneToMany(mappedBy: "tutor", targetEntity: Course::class)]
    private $courses;

    public function __construct()
    {
        $this->courses = new ArrayCollection();
    }
}
