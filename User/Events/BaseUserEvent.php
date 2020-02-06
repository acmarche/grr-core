<?php

namespace Grr\Core\User\Events;

use Grr\Core\Contrat\Entity\Security\UserInterface;
use Symfony\Contracts\EventDispatcher\Event;

class BaseUserEvent extends Event
{
    /**
     * @var UserInterface
     */
    private $user;

    public function __construct(UserInterface $user)
    {
        $this->user = $user;
    }

    public function getUser(): UserInterface
    {
        return $this->user;
    }
}
