<?php

namespace Grr\Core\TypeEntry\Message;

final readonly class TypeEntryAreaAssociated
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
