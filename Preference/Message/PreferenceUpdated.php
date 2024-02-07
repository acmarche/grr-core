<?php

namespace Grr\Core\Preference\Message;

final readonly class PreferenceUpdated
{
    public function __construct(
        private int $preferenceId
    ) {
    }

    public function getPreferenceId(): int
    {
        return $this->preferenceId;
    }
}
