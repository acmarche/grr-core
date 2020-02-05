<?php

namespace Grr\Core\Factory;

use Carbon\CarbonInterface;
use Grr\Core\I18n\LocalHelper;
use Grr\Core\Model\Day;

class DayFactory
{
    /**
     * @var \Grr\Core\Factory\CarbonFactory|mixed
     */
    public $carbonFactory;
    /**
     * @var LocalHelper
     */
    private $localHelper;

    public function __construct(CarbonFactory $carbonFactory, LocalHelper $localHelper)
    {
        $this->carbonFactory = $carbonFactory;
        $this->localHelper = $localHelper;
    }

    public function createImmutable(int $year, int $month, int $day): Day
    {
        $date = $this->carbonFactory->createImmutable($year, $month, $day);

        $dayModel = new Day($date);
        $dayModel->locale($this->localHelper->getDefaultLocal());

        return $dayModel;
    }

    public function createFromCarbon(CarbonInterface $carbon): Day
    {
        $dayModel = new Day($carbon);
        $dayModel->locale($this->localHelper->getDefaultLocal());

        return $dayModel;
    }
}
