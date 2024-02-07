<?php

namespace Grr\Core\Entry\Message;

final readonly class EntryInitialized
{
    public function __construct(
        private ?int $entryId
    ) {
    }

    public function getEntryId(): ?int
    {
        return $this->entryId;
    }
}
