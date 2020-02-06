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

    public function __construct(SettingInterface $setting)
    {
        $this->setting = $setting;
    }

    public function getSetting(): SettingInterface
    {
        return $this->setting;
    }
}
