<?php

namespace Grr\Core\Room\Message;

final class RoomUpdated
{
    /**
     * @var int
     */
    private $roomId;

    public function __construct(int $roomId)
    {
        $this->roomId = $roomId;
    }

    public function getRoomId(): int
    {
        return $this->roomId;
    }
}
