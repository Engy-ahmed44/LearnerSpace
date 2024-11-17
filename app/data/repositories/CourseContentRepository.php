<?php

namespace App\DB\Repository;

use App\DB\Entity\CourseContent;

/**
 * @extends BaseRepository<CourseContent>
 */
class CourseContentRepository extends BaseRepository
{
    protected static function getEntityClass()
    {
        return CourseContent::class;
    }

    /**
     * Create a new course content.
     *
     * @param CourseContent $content
     */
    public function create(CourseContent $content): void
    {
        $this->getEntityManager()->persist($content);
        $this->getEntityManager()->flush();
    }

    /**
     * Update course content.
     *
     * @param CourseContent $content
     */
    public function update(CourseContent $content): void
    {
        $this->getEntityManager()->flush();
    }
}
