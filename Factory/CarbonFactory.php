<?php

namespace Grr\Core\Factory;

use Carbon\Carbon;
use Carbon\CarbonInterface;
use DateTimeInterface;
use Grr\Core\I18n\LocalHelper;

class CarbonFactory
{
    /**
     * @var LocalHelper
     */
    private $localHelper;

    public function __construct(LocalHelper $localHelper)
    {
        $this->localHelper = $localHelper;
    }

    public function today(): CarbonInterface
    {
        return $this->setLocale(Carbon::today());
    }

    public function instance(DateTimeInterface $date): CarbonInterface
    {
        return $this->setLocale(Carbon::instance($date));
    }

    public function setLocale(CarbonInterface $date): CarbonInterface
    {
        return $date->locale($this->localHelper->getDefaultLocal());
    }
}
