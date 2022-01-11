<?php

namespace Grr\Core\Entry\Message;

final class EntryDeleted
{
    public function __construct(
        private int $entryId
    ) {
    }

    public function getEntryId(): int
    {
        return $this->entryId;
    }
}
