<?php

namespace Grr\Core\Provider;

use Carbon\Carbon;
use Carbon\CarbonInterface;
use Carbon\CarbonPeriod;
use Grr\Core\I18n\LocalHelper;

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
        return Carbon::parse($date->firstOfMonth())->daysUntil(
            $date->endOfMonth()
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
        $today = Carbon::instance($date);
        $firstDayMonth = $today->firstOfMonth();

        $firstDayWeek = $firstDayMonth->copy()->startOfWeek()->toMutable();

        do {
            $weeks[] = self::daysOfWeek($firstDayWeek); // point at the end of Week
            $firstDayWeek->nextWeekday();
        } while ($firstDayWeek->isSameMonth($firstDayMonth));

        return $weeks;
    }

    public static function daysOfWeek(CarbonInterface $date): CarbonPeriod
    {
        $debut = $date->toDateString();
        $fin = $date->endOfWeek()->toDateString(); //+7

        return Carbon::parse($debut)->daysUntil($fin);
    }
}
