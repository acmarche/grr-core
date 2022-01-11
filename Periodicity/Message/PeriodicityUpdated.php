<?php

namespace Grr\Core\Periodicity\Message;

final class PeriodicityUpdated
{
    public function __construct(
        private ?int $periodicityId
    ) {
    }

    public function getPeriodicityId(): ?int
    {
        return $this->periodicityId;
    }
}
