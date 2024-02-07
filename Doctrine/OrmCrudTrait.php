<?php

namespace Grr\Core\Doctrine;

use Doctrine\ORM\EntityManager;

trait OrmCrudTrait
{
    /**
     * @var EntityManager
     */
    protected $_em;

    public function persist(object $entity): void
    {
        $this->_em->persist($entity);
    }

    public function flush(): void
    {
        $this->_em->flush();
    }

    public function remove(object $entity): void
    {
        $this->_em->remove($entity);
    }

    public function getOriginalEntityData(object $entity)
    {
        return $this->_em->getUnitOfWork()->getOriginalEntityData($entity);
    }
}
