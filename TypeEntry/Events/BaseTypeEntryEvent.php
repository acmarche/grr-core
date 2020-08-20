<?php

namespace Grr\Core\TypeEntry\Events;

use Grr\Core\Contrat\Entity\TypeEntryInterface;
use Symfony\Contracts\EventDispatcher\Event;

class BaseTypeEntryEvent extends Event
{
    /**
     * @var TypeEntryInterface
     */
    private $typeEntry;

    public function __construct(TypeEntryInterface $typeEntry)
    {
        $this->typeEntry = $typeEntry;
    }

    public function getTypeEntry(): TypeEntryInterface
    {
        return $this->typeEntry;
    }
}
