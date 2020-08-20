<?php

namespace Grr\Core\TypeEntry\Events;

use Grr\Core\Contrat\Entity\TypeEntryInterface;
use Symfony\Contracts\EventDispatcher\Event;

class BaseTypeEntryEvent extends Event
{
    /**
     * @var TypeEntryInterface
     */
    private $user;

    public function __construct(TypeEntryInterface $area)
    {
        $this->user = $area;
    }

    public function getTypeEntry(): TypeEntryInterface
    {
        return $this->user;
    }
}
