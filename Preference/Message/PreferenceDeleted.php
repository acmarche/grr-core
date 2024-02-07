<?php

namespace Grr\Core\Preference\Message;

final readonly class PreferenceDeleted
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
