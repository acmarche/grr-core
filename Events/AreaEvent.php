<?php

namespace Grr\Core\Events;

use Grr\Core\Entity\AreaInterface;
use Symfony\Contracts\EventDispatcher\Event;

class AreaEvent extends Event
{
    const NEW_SUCCESS = 'grr.area.new.success';
    const EDIT_SUCCESS = 'grr.area.edit.success';
    const DELETE_SUCCESS = 'grr.area.delete.success';

    /**
     * @var AreaInterface
     */
    private $area;

    public function __construct(AreaInterface $area)
    {
        $this->area = $area;
    }

    public function getArea(): AreaInterface
    {
        return $this->area;
    }
}
