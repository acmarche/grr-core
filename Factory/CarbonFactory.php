<?php

namespace Grr\Core\Factory;

use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Carbon\CarbonInterface;
use DateTimeInterface;
use Grr\Core\I18n\LocalHelper;

class CarbonFactory
{
    public function __construct(
        private readonly LocalHelper $localHelper
    ) {
    }

    public function today(): CarbonInterface
    {
        return $this->setLocale(Carbon::today());
    }

    public function instance(DateTimeInterface $date): CarbonInterface
    {
        return $this->setLocale(Carbon::instance($date));
    }

    public function instanceImmutable(DateTimeInterface $date): CarbonImmutable
    {
        $dateCreated = $this->setLocale(Carbon::instance($date));

        return $dateCreated->toImmutable();
    }

    public function setLocale(CarbonInterface $date): CarbonInterface|string
    {
        return $date->locale($this->localHelper->getDefaultLocal());
    }
}
