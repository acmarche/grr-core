<?php

namespace Grr\Core\Periodicity\Message;

final class PeriodicityUpdated
{
    private ?int $periodicityId;

    public function __construct(?int $periodicityId)
    {
        $this->periodicityId = $periodicityId;
    }

    public function getPeriodicityId(): int
    {
        return $this->periodicityId;
    }
}
