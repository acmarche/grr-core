<?php

namespace Grr\Core\Setting\Message;

final readonly class SettingUpdated
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
