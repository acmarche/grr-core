<?php

namespace Grr\Core\User\Message;

final class UserUpdated
{
    public function __construct(
        private int $userId
    ) {
    }

    public function getUserId(): int
    {
        return $this->userId;
    }
}
