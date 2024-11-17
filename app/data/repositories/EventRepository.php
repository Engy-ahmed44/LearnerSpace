<?php

namespace App\DB\Repository;

use App\Entity\Event;

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
}
