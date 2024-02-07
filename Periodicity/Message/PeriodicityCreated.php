<?php

namespace Grr\Core\Periodicity\Message;

final readonly class PeriodicityCreated
{
    public function __construct(
        private int $periodicityId
    ) {
    }

    public function getPeriodicityId(): int
    {
        return $this->periodicityId;
    }
}
