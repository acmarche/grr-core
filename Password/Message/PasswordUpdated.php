<?php

namespace Grr\Core\Password\Message;

final readonly class PasswordUpdated
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
