<?php

namespace Grr\Core\Authorization\Message;

final class AuthorizationDeleted
{
    /**
     * @var int
     */
    private $authorizationId;

    public function __construct(int $authorizationId)
    {
        $this->authorizationId = $authorizationId;
    }

    public function getAuthorizationId(): int
    {
        return $this->authorizationId;
    }
}
