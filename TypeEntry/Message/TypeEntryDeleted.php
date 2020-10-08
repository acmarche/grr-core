<?php

namespace Grr\Core\TypeEntry\Message;

final class TypeEntryDeleted
{
    /**
     * @var int
     */
    private $typeEntryId;

    public function __construct(int $typeEntryId)
    {
        $this->typeEntryId = $typeEntryId;
    }

    public function getTypeEntryId(): int
    {
        return $this->typeEntryId;
    }
}
