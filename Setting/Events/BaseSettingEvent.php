<?php

namespace Grr\Core\Setting\Events;

use Grr\Core\Contrat\Entity\SettingEntityInterface;
use Symfony\Contracts\EventDispatcher\Event;

class BaseSettingEvent extends Event
{
    /**
     * @var SettingEntityInterface
     */
    private $setting;

    public function __construct(array $settings)
    {
        $this->setting = $settings;
    }

    /**
     * @return SettingEntityInterface[]
     */
    public function getSettings(): \Grr\Core\Contrat\Entity\SettingEntityInterface
    {
        return $this->setting;
    }
}
