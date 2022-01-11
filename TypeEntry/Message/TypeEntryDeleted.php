<?php

namespace Grr\Core\TypeEntry\Message;

final class TypeEntryDeleted
{
    public function __construct(
        private int $typeEntryId
    ) {
    }

    public function getTypeEntryId(): int
    {
        return $this->typeEntryId;
    }
}
