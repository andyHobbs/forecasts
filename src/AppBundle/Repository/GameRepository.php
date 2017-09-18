<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Game;
use AppBundle\Entity\User;
use Doctrine\ORM\EntityRepository;

/**
 * GameRepository
 */
class GameRepository extends EntityRepository
{
    /**
     * Get Game by status
     *
     * @param integer $status
     *
     * @return Game[]
     */
    public function getByStatus($status)
    {
        $qb = $this->createQueryBuilder('g');

        return $qb->where($qb->expr()->eq('g.status', ':status'))
            ->setParameter('status', $status)
            ->orderBy('g.startedAt', 'DESC')
            ->getQuery()
            ->getResult();
    }

}
