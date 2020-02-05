<?php

namespace Grr\Core\Contrat\Repository;

use Doctrine\ORM\QueryBuilder;

interface AreaRepositoryInterface
{
    public function getQueryBuilder(): QueryBuilder;
}
