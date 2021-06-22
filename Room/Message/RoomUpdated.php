<?php

namespace Grr\Core\Room\Message;

final class RoomUpdated
{
    private int $roomId;

    public function __construct(int $roomId)
    {
        $this->roomId = $roomId;
    }

    public function getRoomId(): int
    {
        return $this->roomId;
    }
}
