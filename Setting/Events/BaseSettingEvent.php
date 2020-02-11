<?php

namespace Grr\Core\Setting\Events;

use Grr\Core\Contrat\Entity\SettingInterface;
use Symfony\Contracts\EventDispatcher\Event;

class BaseSettingEvent extends Event
{
    /**
     * @var SettingInterface
     */
    private $settings;

    public function __construct(array $settings)
    {
        $this->settings = $settings;
    }

    /**
     * @return SettingInterface[]
     */
    public function getSettings(): array
    {
        return $this->settings;
    }
}
