<?php

namespace Grr\Core\Events;

use Grr\Core\Entity\EntryTypeInterface;
use Symfony\Contracts\EventDispatcher\Event;

class EntryTypeEvent extends Event
{
    const NEW_SUCCESS = 'grr.entry_type.new.success';
    const EDIT_SUCCESS = 'grr.entry_type.edit.success';
    const DELETE_SUCCESS = 'grr.entry_type.delete.success';

    /**
     * @var EntryTypeInterface
     */
    private $entry_type;

    public function __construct(EntryTypeInterface $entryType)
    {
        $this->entry_type = $entryType;
    }

    public function getEntryType(): EntryTypeInterface
    {
        return $this->entry_type;
    }
}
