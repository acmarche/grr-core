<?php

namespace Grr\Core\Events;

use Grr\Core\Entity\RoomInterface;
use Symfony\Contracts\EventDispatcher\Event;

class RoomEvent extends Event
{
    const NEW_SUCCESS = 'grr.room.new.success';
    const EDIT_SUCCESS = 'grr.room.edit.success';
    const DELETE_SUCCESS = 'grr.room.delete.success';

    /**
     * @var RoomInterface
     */
    private $room;

    public function __construct(RoomInterface $room)
    {
        $this->room = $room;
    }

    public function getRoom(): RoomInterface
    {
        return $this->room;
    }
}
