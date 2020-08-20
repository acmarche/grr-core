<?php
/**
 * Created by PhpStorm.
 * User: jfsenechal
 * Date: 12/03/19
 * Time: 16:22.
 */

namespace Grr\Core\Model;

use Carbon\Carbon;
use Carbon\CarbonInterface;
use Carbon\CarbonPeriod;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Webmozart\Assert\Assert;

/**
 * @todo https://www.doctrine-project.org/projects/doctrine-collections/en/1.6/index.html
 * Class Month
 */
class Month extends Carbon
{
    /**
     * @var Day[]|ArrayCollection
     */
    protected $data_days;
    /**
     * @var CarbonInterface
     */
    private $carbon;

    public function setCarbon(): void
    {
        $this->carbon = new Carbon();
    }

    public function getCarbon(): CarbonInterface
    {
        return $this->carbon;
    }

    public static function init(int $year, int $month, string $language): self
    {
        Assert::greaterThan($year, 1970);
        Assert::greaterThan($month, 0);
        Assert::lessThan($month, 13);

        $self = new self();
        $self->setDate($year, $month, 01);
        $self->locale($language);
        $self->setCarbon();
        $self->data_days = new ArrayCollection();

        return $self;
    }

    public function previousYear(): CarbonInterface
    {
        return $this->copy()->subYear();
    }

    public function nextYear(): CarbonInterface
    {
        return $this->copy()->addYear();
    }

    public function previousMonth(): CarbonInterface
    {
        return $this->copy()->subMonth();
    }

    public function nextMonth(): CarbonInterface
    {
        return $this->copy()->addMonth();
    }

    public function getCalendarDays(): CarbonPeriod
    {
        return Carbon::parse($this->firstOfMonth()->toDateString())->daysUntil(
            $this->endOfMonth()->toDateString()
        );
    }

    /**
     * Retourne la liste des semaines.
     *
     * @return CarbonPeriod[]
     */
    public function getWeeksOfMonth(): array
    {
        $weeks = [];
        $firstDayMonth = $this->firstOfMonth();

        $firstDayWeek = $firstDayMonth->copy()->startOfWeek()->toMutable();

        do {
            $weeks[] = $this->getWeekOfMonth($firstDayWeek); // point at end ofWeek
            $firstDayWeek->nextWeekday();
        } while ($firstDayWeek->isSameMonth($firstDayMonth));

        return $weeks;
    }

    public function getWeekOfMonth(CarbonInterface $carbon): CarbonPeriod
    {
        $debut = $carbon->toDateString();
        $fin = $carbon->endOfWeek()->toDateString();

        return Carbon::parse($debut)->daysUntil($fin);
    }

    public function addDataDay(Day $day): void
    {
        if (!$this->data_days->contains($day)) {
            $this->data_days[] = $day;
        }
    }

    /**
     * Tous les jours du mois sous forme de DayModel avec les entrées.
     *
     * @return Collection|Day[]
     */
    public function getDataDays(): Collection
    {
        return $this->data_days;
    }

    /**
     * @throws \Exception
     */
    public function groupDataDaysByWeeks(): array
    {
        $weeks = [];
        foreach ($this->getWeeksOfMonth() as $weekCalendar) {
            $days = [];
            foreach ($weekCalendar as $dayCalendar) {
                $dayModel = $this->findDataDayWithDate($dayCalendar);
                // $days [] = $dayCalendar;
                $days[] = $dayModel;
            }
            $weeks[]['days'] = $days;
        }

        return $weeks;
    }

    /**
     * @param CarbonInterface $dayCalendar
     *
     *
     * @throws \Exception
     */
    protected function findDataDayWithDate($dayCalendar): \Grr\Core\Model\Day
    {
        foreach ($this->getDataDays() as $dataDay) {
            if ($dataDay->toDateString() === $dayCalendar->toDateString()) {
                return $dataDay;
            }
        }

        //if month 08 and first day of week 29/07
        return new Day($dayCalendar);
    }
}
