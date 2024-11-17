<?php

namespace App\DB\Repository;

use App\Entity\CommunityPost;

/**
 * @extends BaseRepository<CommunityPost>
 */
class CommunityPostRepository extends BaseRepository
{
    protected static function getEntityClass()
    {
        return CommunityPost::class;
    }

    /**
     * Create a new community post.
     *
     * @param CommunityPost $post
     */
    public function create(CommunityPost $post): void
    {
        $this->getEntityManager()->persist($post);
        $this->getEntityManager()->flush();
    }

    /**
     * Update a community post.
     *
     * @param CommunityPost $post
     */
    public function update(CommunityPost $post): void
    {
        $this->getEntityManager()->flush();
    }

    /**
     * Get all community posts ordered by creation date.
     *
     * @return CommunityPost[]
     */
    public function findAllOrderedByCreatedAt(): array
    {
        return $this->createQueryBuilder('p')
            ->orderBy('p.createdAt', 'ASC')
            ->getQuery()
            ->getResult();
    }
}
