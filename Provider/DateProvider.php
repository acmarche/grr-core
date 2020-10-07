<?php

namespace Grr\Core\Provider;

use Carbon\Carbon;
use Carbon\CarbonInterface;
use Carbon\CarbonPeriod;

class DateProvider
{
    /**
     * Names of days of the week.
     *
     * @return string[]
     */
    public static function getNamesDaysOfWeek(): array
    {
        //todo dynamic first day of week
        //https://carbon.nesbot.com/docs/#api-week
        //$en->firstWeekDay); != $fr->firstWeekDay);

        /*  $days = [];
      /*  $translator = \Carbon\Translator::get(
              LocalHelper::getDefaultLocal()
          );

          foreach (Carbon::getDays() as $day) {
              $days[] = $translator->trans($day);
          }*/
        $days = Carbon::getDays();
        //if lundi first, on pousse dimanche a la fin
        $days[] = $days[0];
        unset($days[0]);

        return $days;
    }

    public static function createCarbon(\DateTimeInterface $dateTime): CarbonInterface
    {
        return Carbon::instance($dateTime);
    }

    /**
     * @return int[]
     */
    public static function getHours(): array
    {
        return range(1, CarbonInterface::HOURS_PER_DAY);
    }

    public static function daysOfMonth(\DateTimeInterface $date): CarbonPeriod
    {
        $carbon = Carbon::instance($date);

        return Carbon::parse($carbon->firstOfMonth())->daysUntil(
            $carbon->endOfMonth()
        );
    }

    /**
     * Retourne la liste des semaines.
     *
     * @return CarbonPeriod[]
     */
    public static function weeksOfMonth(\DateTimeInterface $date): array
    {
        $weeks = [];
        $firstDayMonth = Carbon::instance($date)->firstOfMonth();

        do {
            $weeks[] = self::daysOfWeek($firstDayMonth); // point at the end of Week
            $firstDayMonth->nextWeekday(); //passe de dimanche a lundi
        } while ($firstDayMonth->isSameMonth($date));

        return $weeks;
    }

    public static function daysOfWeek(CarbonInterface $date): CarbonPeriod
    {
        $firstDayOfWeek = $date->copy()->startOfWeek()->toMutable()->toDateString();
        $lastDayOffWeek = $date->endOfWeek()->toDateString(); //+6

        return Carbon::parse($firstDayOfWeek)->daysUntil($lastDayOffWeek)->locale('fr'); //todo locale
    }
}
