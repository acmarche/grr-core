<?php

namespace Grr\Core\Periodicity;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Grr\Core\Contrat\Entity\EntryInterface;
use Grr\Core\Contrat\Entity\PeriodicityInterface;

class Weekly
{
    /**
     * @var \Carbon\Carbon|mixed
     */
    public $entry_start;
    /**
     * @var \Carbon\Carbon|mixed
     */
    public $periodicity_end;
    public function getDaysByEntry(EntryInterface $entry)
    {
        $periodicity = $entry->getPeriodicity();

        if (null === $periodicity) {
            return [];
        }

        $startTime = $entry->getStartTime();
        $typePeriodicity = $periodicity->getType();

        $this->entry_start = Carbon::instance($startTime);
        $this->periodicity_end = Carbon::instance($periodicity->getEndTime());

        if (PeriodicityConstant::EVERY_WEEK === $typePeriodicity) {
            return $this->forEveryWeek($periodicity);
        }
    }

    protected function forEveryWeek(PeriodicityInterface $periodicity): CarbonPeriod
    {
        /**
         * monday, tuesday, wednesday.
         *
         * @example : [1,2,3]
         */
        $weekDays = $periodicity->getWeekDays();
        /**
         * @example 1 for every weeks, 2 every 2 weeks, 3,4...
         */
        $weekRepeat = $periodicity->getWeekRepeat();

        /**
         * filter days of the week.
         *
         * @param $date
         *
         * @return bool
         */
        $filterDayOfWeek = function ($date) use ($days): bool {
            return in_array($date->dayOfWeekIso, $days, true);
        };

        /**
         * Carbon::class
         * $this->entry_start
         * $this->periodicity_end.
         */
        $period = Carbon::parse($this->entry_start->toDateString())->daysUntil(
            $this->periodicity_end->toDateString()
        );

        /**
         * filter every x weeks.
         *
         * @param $date
         *
         * @return bool
         */
        $filterWeek = function ($date) use ($repeat_week): bool {
            return 0 === $date->weekOfYear % $repeat_week;
        };

        $period->excludeStartDate();
        $period->addFilter($filterDayOfWeek);

        if ($weekRepeat > 1) {
            $period->addFilter($filterWeek);
        }

        return $period;
    }
}
