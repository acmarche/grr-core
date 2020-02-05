<?php

namespace Grr\Core\Events;

use Grr\Core\Contrat\Entity\EntryInterface;
use Symfony\Contracts\EventDispatcher\Event;

class EntryEvent extends Event
{
    const NEW_INITIALIZE = 'grr.entry.new.initialize';
    const NEW_SUCCESS = 'grr.entry.new.success';
    const EDIT_SUCCESS = 'grr.entry.edit.success';
    const DELETE_SUCCESS = 'grr.entry.delete.success';

    /**
     * @var EntryInterface
     */
    private $entry;

    public function __construct(EntryInterface $entry)
    {
        $this->entry = $entry;
    }

    public function getEntry(): EntryInterface
    {
        return $this->entry;
    }
}
