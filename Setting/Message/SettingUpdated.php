<?php

namespace Grr\Core\Setting\Message;

final class SettingUpdated
{
    /**
     * @var array
     */
    private $settingsId;

    public function __construct(array $settingsId)
    {
        $this->settingsId = $settingsId;
    }

    public function getSettingId(): array
    {
        return $this->settingsId;
    }
}
