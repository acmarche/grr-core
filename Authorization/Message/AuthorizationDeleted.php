<?php

namespace Grr\Core\Authorization\Message;

final class AuthorizationDeleted
{
    private int $authorizationId;

    public function __construct(int $authorizationId)
    {
        $this->authorizationId = $authorizationId;
    }

    public function getAuthorizationId(): int
    {
        return $this->authorizationId;
    }
}
