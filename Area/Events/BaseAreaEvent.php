<?php

namespace Grr\Core\Area\Events;

use Grr\Core\Contrat\Entity\AreaInterface;
use Symfony\Contracts\EventDispatcher\Event;

class BaseAreaEvent extends Event
{
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
