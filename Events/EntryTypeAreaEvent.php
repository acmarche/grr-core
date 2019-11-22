<?php

namespace Grr\Core\Events;

use Grr\Core\Entity\AreaInterface;
use Symfony\Contracts\EventDispatcher\Event;

class EntryTypeAreaEvent extends Event
{
    /**
     * @var AreaInterface
     */
    private $area;

    public function __construct(AreaInterface $area)
    {
        $this->area = $area;
    }

    public function getArea(): AreaInterface
    {
        return $this->area;
    }
}
