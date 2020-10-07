<?php

namespace Grr\Core\Factory;

use Carbon\CarbonInterface;
use Grr\Core\I18n\LocalHelper;
use Grr\Core\Model\DataDay;

class DataDayFactory
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

    public function createImmutable(int $year, int $month, int $day): DataDay
    {
        $date = $this->carbonFactory->createImmutable($year, $month, $day);

        $dayModel = new DataDay($date);
        $dayModel->getDay()->locale($this->localHelper->getDefaultLocal());

        return $dayModel;
    }

    public function createFromCarbon(CarbonInterface $carbon): DataDay
    {
        $day = new DataDay($carbon);
        $day->getDay()->locale($this->localHelper->getDefaultLocal());

        return $day;
    }
}
