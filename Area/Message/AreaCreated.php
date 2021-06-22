<?php

namespace Grr\Core\Area\Message;

final class AreaCreated
{
    private int $areaId;

    public function __construct(int $areaId)
    {
        $this->areaId = $areaId;
    }

    public function getAreaId(): int
    {
        return $this->areaId;
    }
}
