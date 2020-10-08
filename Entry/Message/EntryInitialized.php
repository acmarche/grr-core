<?php

namespace Grr\Core\Entry\Message;

final class EntryInitialized
{
    /**
     * @var int
     */
    private $entryId;

    public function __construct(int $entryId)
    {
        $this->entryId = $entryId;
    }

    public function getEntryId(): int
    {
        return $this->entryId;
    }
}
