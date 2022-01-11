<?php

namespace Grr\Core\Periodicity;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use DateTime;
use DateTimeImmutable;
use DateTimeInterface;
use Grr\Core\Contrat\Entity\EntryInterface;
use Grr\Core\Contrat\Entity\PeriodicityInterface;

class Weekly
{
    /**
     * @var DateTime|DateTimeImmutable|null
     */
    public ?DateTimeInterface $entry_start = null;
    /**
     * @var DateTime|DateTimeImmutable|null
     */
    public ?DateTimeInterface $periodicity_end = null;

    public function getDaysByEntry(EntryInterface $entry)
    {
        $periodicity = $entry->getPeriodicity();

        if (! $periodicity instanceof PeriodicityInterface) {
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
        $days = null;
        $repeat_week = null;
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
        $filterDayOfWeek = fn ($date): bool => \in_array($date->dayOfWeekIso, $days, true);

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
        $filterWeek = fn ($date): bool => 0 === $date->weekOfYear % $repeat_week;

        $period->excludeStartDate();
        $period->addFilter($filterDayOfWeek);

        if ($weekRepeat > 1) {
            $period->addFilter($filterWeek);
        }

        return $period;
    }
}
