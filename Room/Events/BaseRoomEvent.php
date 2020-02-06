<?php

namespace Grr\Core\Room\Events;

use Grr\Core\Contrat\Entity\RoomInterface;
use Symfony\Contracts\EventDispatcher\Event;

class BaseRoomEvent extends Event
{
    /**
     * @var RoomInterface
     */
    private $room;

    public function __construct(RoomInterface $area)
    {
        $this->room = $area;
    }

    public function getRoom(): RoomInterface
    {
        return $this->room;
    }
}
