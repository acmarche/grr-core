<?php

namespace Grr\Core\Periodicity\Message;

final class PeriodicityUpdated
{
    /**
     * @var int
     */
    private $periodicityId;

    public function __construct(?int $periodicityId)
    {
        $this->periodicityId = $periodicityId;
    }

    public function getPeriodicityId(): ?int
    {
        return $this->periodicityId;
    }
}
