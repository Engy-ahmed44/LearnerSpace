<?php

namespace App\DB\Repository;

use App\DB\Entity\Course;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Course>
 */
class CourseRepository extends BaseRepository
{
	/**
	 * Get the entity class associated with this repository
	 *
	 * @return string
	 */
	protected static function getEntityClass()
	{
		return Course::class;
	}

	public function __construct(ManagerRegistry $registry)
	{
		parent::__construct($registry, Course::class);
	}

	/**
	 * Find courses by a partial name.
	 *
	 * @param string $name
	 * @return Course[]
	 */
	public function findByName(string $name): array
	{
		return $this->createQueryBuilder('c')
			->where('c.name LIKE :name')
			->setParameter('name', '%' . $name . '%')
			->getQuery()
			->getResult();
	}

	/**
	 * Get all courses ordered by creation date.
	 *
	 * @return Course[]
	 */
	public function findAllOrderedByCreatedAt(): array
	{
		return $this->createQueryBuilder('c')
			->orderBy('c.created_at', 'ASC')
			->getQuery()
			->getResult();
	}
}
