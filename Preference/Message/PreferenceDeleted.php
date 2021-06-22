<?php

namespace Grr\Core\Preference\Message;

final class PreferenceDeleted
{
    private int $preferenceId;

    public function __construct(int $preferenceId)
    {
        $this->preferenceId = $preferenceId;
    }

    public function getPreferenceId(): int
    {
        return $this->preferenceId;
    }
}
