<?php

namespace App\DB\Repository;

use App\DB\Entity\Event;
use Doctrine\Common\Collections\Collection;

/**
 * @extends BaseRepository<Event>
 */
class EventRepository extends BaseRepository
{
    protected static function getEntityClass()
    {
        return Event::class;
    }

    /**
     * Create a new event.
     *
     * @param Event $event
     */
    public function create(Event $event): void
    {
        $this->getEntityManager()->persist($event);
        $this->getEntityManager()->flush();
    }

    /**
     * Update an event.
     *
     * @param Event $event
     */
    public function update(Event $event): void
    {
        $this->getEntityManager()->flush();
    }

    public function findLatestByCourses(Collection $courses): array
    {
        return $this->createQueryBuilder('e')
            ->where('e.course IN (:courses)')
            ->setParameter('courses', $courses)
            ->orderBy('e.date', 'DESC')
            ->setMaxResults(5) // Fetch only the latest 5 events
            ->getQuery()
            ->getResult();
    }
}
