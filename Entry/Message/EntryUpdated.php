<?php

namespace Grr\Core\Entry\Message;

final readonly class EntryUpdated
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
