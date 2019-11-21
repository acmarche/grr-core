<?php

namespace Grr\Core\Repository;

use Doctrine\ORM\QueryBuilder;

interface AreaRepositoryInterface
{
    public function getQueryBuilder(): QueryBuilder;
}
