<?php

namespace Grr\Core\Periodicity\Events;

use Grr\Core\Contrat\Entity\PeriodicityInterface;
use Symfony\Contracts\EventDispatcher\Event;

class BasePeriodicityEvent extends Event
{
    /**
     * @var PeriodicityInterface
     */
    private $periodicity;

    public function __construct(PeriodicityInterface $periodicity)
    {
        $this->periodicity = $periodicity;
    }

    public function getPeriodicity(): PeriodicityInterface
    {
        return $this->periodicity;
    }
}
