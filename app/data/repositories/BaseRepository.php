<?php

namespace App\DB\Repository;

use App\DB\DatabaseManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

/**
 * @template T of object
 */
abstract class BaseRepository extends EntityRepository
{
    /**
     * Get the repository instance based on the entity manager
     * 
     * @return static
     */
    public static function get()
    {
        // We need to return the repository for the actual entity class, not the repository class
        return DatabaseManager::getInstance()->getEntityManager()->getRepository(static::getEntityClass());
    }

    /**
     * Get the entity class associated with the repository
     *
     * @return string
     */
    abstract protected static function getEntityClass();
}
