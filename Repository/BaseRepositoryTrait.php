<?php

namespace Grr\Core\Repository;

use Doctrine\ORM\EntityManagerInterface;

/**
 * @method EntityManagerInterface getEntityManager()
 */
trait BaseRepositoryTrait
{
    public function persist(BaseEntity $baseEntity): void
    {
        $em = $this->getEntityManager();
        $em->persist($baseEntity);
        $em->flush();
    }
}
