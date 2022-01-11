<?php

namespace Grr\Core\Entry\Message;

final class EntryCreated
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
