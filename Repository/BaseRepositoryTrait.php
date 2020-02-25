<?php

namespace Grr\Core\Repository;

use Doctrine\ORM\EntityManagerInterface;

/**
 * @method EntityManagerInterface getEntityManager()
 */
trait BaseRepositoryTrait
{
    public function persist(BaseEntity $entity): void
    {
        $em = $this->getEntityManager();
        $em->persist($entity);
        $em->flush();
    }
}
