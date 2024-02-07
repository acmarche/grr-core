<?php

namespace Grr\Core\Room\Message;

final readonly class RoomDeleted
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
