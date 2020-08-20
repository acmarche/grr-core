<?php

namespace Grr\Core\Setting\Events;

use Grr\Core\Contrat\Entity\SettingInterface;
use Symfony\Contracts\EventDispatcher\Event;

class BaseSettingEvent extends Event
{
    /**
     * @var SettingInterface
     */
    private $setting;

    public function __construct(array $settings)
    {
        $this->setting = $settings;
    }

    /**
     * @return SettingInterface[]
     */
    public function getSettings(): \Grr\Core\Contrat\Entity\SettingInterface
    {
        return $this->setting;
    }
}
