<?php

namespace Grr\Core\Authorization\Events;

use Grr\Core\Contrat\Entity\Security\AuthorizationInterface;
use Symfony\Contracts\EventDispatcher\Event;

class BaseAuthorizationEvent extends Event
{
    /**
     * @var AuthorizationInterface|null
     */
    private $authorization;

    public function __construct(?AuthorizationInterface $authorization = null)
    {
        $this->authorization = $authorization;
    }

    public function getAuthorization(): AuthorizationInterface
    {
        return $this->authorization;
    }
}
