<?php

namespace Grr\Core\Events;

use Grr\Core\Contrat\Entity\Security\UserInterface;
use Symfony\Contracts\EventDispatcher\Event;

class UserEvent extends Event
{
    const NEW_SUCCESS = 'grr.user.new.success';
    const EDIT_SUCCESS = 'grr.user.edit.success';
    const DELETE_SUCCESS = 'grr.user.delete.success';
    const CHANGE_PASSWORD_SUCCESS = 'grr.user.password.success';

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
