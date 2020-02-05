<?php

namespace Grr\Core\Events;

use Grr\Core\Contrat\Entity\Security\AuthorizationInterface;
use Symfony\Contracts\EventDispatcher\Event;

class AuthorizationEvent extends Event
{
    const NEW_SUCCESS = 'grr.authorization.new.success';
    const EDIT_SUCCESS = 'grr.authorization.edit.success';
    const DELETE_SUCCESS = 'grr.authorization.delete.success';

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
