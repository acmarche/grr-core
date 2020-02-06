<?php

namespace Grr\Core\Entry\Events;

use Grr\Core\Contrat\Entity\EntryInterface;
use Symfony\Contracts\EventDispatcher\Event;

class BaseEntryEvent extends Event
{
    /**
     * @var EntryInterface
     */
    protected $entry;

    public function __construct(EntryInterface $entry)
    {
        $this->entry = $entry;
    }

    public function getEntry(): EntryInterface
    {
        return $this->entry;
    }
}
