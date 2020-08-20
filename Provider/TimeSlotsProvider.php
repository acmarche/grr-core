<?php

namespace Grr\Core\Provider;

use Carbon\Carbon;
use Carbon\CarbonInterface;
use Carbon\CarbonPeriod;
use Grr\Core\Contrat\Entity\AreaInterface;
use Grr\Core\Contrat\Entity\EntryInterface;
use Grr\Core\Factory\CarbonFactory;
use Grr\Core\Model\TimeSlot;

class TimeSlotsProvider
{
    /**
     * @var CarbonFactory
     */
    private $carbonFactory;

    public function __construct(CarbonFactory $carbonFactory)
    {
        $this->carbonFactory = $carbonFactory;
    }

    /**
     * Crée les tranches d'heures sous forme d'objet.
     *
     * @return TimeSlot[]
     */
    public function getTimeSlotsModelByAreaAndDaySelected(AreaInterface $area, CarbonInterface $carbon): array
    {
        $startTime = $area->getStartTime();
        $endTime = $area->getEndTime();
        $timeInterval = $area->getTimeInterval();

        $carbonPeriod = $this->getTimeSlots($carbon, $startTime, $endTime, $timeInterval);

        $hours = [];
        $carbonPeriod->rewind();
        $last = $carbonPeriod->last();
        $carbonPeriod->rewind();

        while ($carbonPeriod->current()->lessThan($last)) {
            $begin = $carbonPeriod->current();
            $carbonPeriod->next();
            $end = $carbonPeriod->current();

            $hour = new TimeSlot($begin, $end);

            $hours[] = $hour;
        }

        return $hours;
    }

    /**
     * Retourne les tranches d'heures d'après une heure de début, de fin et d'un interval de temps.
     */
    public function getTimeSlots(
        CarbonInterface $carbon,
        int $hourBegin,
        int $hourEnd,
        int $timeInterval
    ): CarbonPeriod {
        $dateBegin = $this->carbonFactory->create(
            $carbon->year,
            $carbon->month,
            $carbon->day,
            $hourBegin,
            0
        );

        $dateEnd = $this->carbonFactory->create($carbon->year, $carbon->month, $carbon->day, $hourEnd, 0, 0);

        return Carbon::parse($dateBegin)->minutesUntil($dateEnd, $timeInterval);
    }

    /**
     * Obtient les tranches horaires de l'entrée basée sur la résolution de l'Area.
     */
    public function getTimeSlotsOfEntry(EntryInterface $entry): CarbonPeriod
    {
        $area = $entry->getRoom()->getArea();
        $entryHourBegin = $entry->getStartTime();
        $entryHourEnd = $entry->getEndTime();

        return Carbon::parse($entryHourBegin)->minutesUntil($entryHourEnd, $area->getTimeInterval());
    }
}
