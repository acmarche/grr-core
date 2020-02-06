<?php

namespace Grr\Core\EntryType\Events;

use Grr\Core\Contrat\Entity\EntryTypeInterface;
use Symfony\Contracts\EventDispatcher\Event;

class BaseEntryTypeEvent extends Event
{
    /**
     * @var EntryTypeInterface
     */
    private $user;

    public function __construct(EntryTypeInterface $area)
    {
        $this->user = $area;
    }

    public function getEntryType(): EntryTypeInterface
    {
        return $this->user;
    }
}
