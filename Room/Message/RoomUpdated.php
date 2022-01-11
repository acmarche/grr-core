<?php

namespace Grr\Core\Room\Message;

final class RoomUpdated
{
    public function __construct(
        private int $roomId
    ) {
    }

    public function getRoomId(): int
    {
        return $this->roomId;
    }
}
