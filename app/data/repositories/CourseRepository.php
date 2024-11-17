<?php

namespace App\DB\Repository;

use App\DB\Entity\Course;

/**
 * @extends BaseRepository<Course>
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
	 * Create a new course.
	 *
	 * @param Course $course
	 */
	public function create(Course $course): void
	{
		$this->getEntityManager()->persist($course);
		$this->getEntityManager()->flush();
	}

	/**
	 * Delete a course.
	 *
	 * @param Course $course
	 */
	public function delete(Course $course): void
	{
		$this->getEntityManager()->remove($course);
		$this->getEntityManager()->flush();
	}

	/**
	 * Get all courses ordered by creation date.
	 *
	 * @return Course[]
	 */
	public function findAllOrderedByCreatedAt(): array
	{
		return $this->createQueryBuilder('c')
			->orderBy('c.createdAt', 'ASC')
			->getQuery()
			->getResult();
	}
}
