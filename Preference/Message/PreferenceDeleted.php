<?php

namespace Grr\Core\Preference\Message;

final class PreferenceDeleted
{
    /**
     * @var int
     */
    private $preferenceId;

    public function __construct(int $preferenceId)
    {
        $this->preferenceId = $preferenceId;
    }

    public function getPreferenceId(): int
    {
        return $this->preferenceId;
    }
}
