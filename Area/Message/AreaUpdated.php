<?php

namespace Grr\Core\Area\Message;

final readonly class AreaUpdated
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
