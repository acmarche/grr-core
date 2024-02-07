<?php

namespace Grr\Core\Preference\Message;

final readonly class PreferenceCreated
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
