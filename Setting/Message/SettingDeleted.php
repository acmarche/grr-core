<?php

namespace Grr\Core\Setting\Message;

final class SettingDeleted
{
    public function __construct(
        private array $settingsId
    ) {
    }

    public function getSettingId(): array
    {
        return $this->settingsId;
    }
}
