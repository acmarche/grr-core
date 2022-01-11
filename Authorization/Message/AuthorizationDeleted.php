<?php

namespace Grr\Core\Authorization\Message;

final class AuthorizationDeleted
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
