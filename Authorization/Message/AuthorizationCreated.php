<?php

namespace Grr\Core\Authorization\Message;

final readonly class AuthorizationCreated
{
    public function __construct(
        private int $authorizationId
    ) {
    }

    public function getAuthorizationId(): int
    {
        return $this->authorizationId;
    }
}
