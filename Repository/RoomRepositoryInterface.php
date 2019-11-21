<?php

namespace Grr\Core\Repository;

use Doctrine\ORM\QueryBuilder;

interface RoomRepositoryInterface
{
    public function getQueryBuilder(): QueryBuilder;
}
