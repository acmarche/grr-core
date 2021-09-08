<?php

namespace Grr\Core\Contrat\Repository;

interface OrmCrudInterface
{
    public function persist(object $entity);

    public function flush();

    public function remove(object $entity);
}
