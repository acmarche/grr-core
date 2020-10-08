<?php

namespace Grr\Core\Area\Message;

final class AreaUpdated
{
    /**
     * @var int
     */
    private $areaId;

    public function __construct(int $areaId)
    {
        $this->areaId = $areaId;
    }

    public function getAreaId(): int
    {
        return $this->areaId;
    }
}
