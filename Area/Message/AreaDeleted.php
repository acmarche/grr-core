<?php

namespace Grr\Core\Area\Message;

final class AreaDeleted
{
    public function __construct(
        private int $areaId
    ) {
    }

    public function getAreaId(): int
    {
        return $this->areaId;
    }
}
