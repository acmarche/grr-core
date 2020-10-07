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
use Grr\Core\Provider\DateProvider;
use Webmozart\Assert\Assert;

/**
 * @todo https://www.doctrine-project.org/projects/doctrine-collections/en/1.6/index.html
 * Class Month
 */
class Month extends Carbon
{
    /**
     * @var DataDay[]|ArrayCollection
     */
    protected $data_days;

    public static function init(int $year, int $month, string $language): self
    {
        Assert::greaterThan($year, 1970);
        Assert::greaterThan($month, 0);
        Assert::lessThan($month, 13);

        $self = new self();
        $self->setDate($year, $month, 01);
        $self->locale($language);
        $self->data_days = new ArrayCollection();

        return $self;
    }

    public function getCalendarDays(): CarbonPeriod
    {
        return Carbon::parse($this->firstOfMonth()->toDateString())->daysUntil(
            $this->endOfMonth()->toDateString()
        );
    }

    public function addDataDay(DataDay $day): void
    {
        if (!$this->data_days->contains($day)) {
            $this->data_days[] = $day;
        }
    }

    /**
     * Tous les jours du mois sous forme de DayModel avec les entrées.
     *
     * @return Collection|DataDay[]
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
        foreach (DateProvider::weeksOfMonth($this) as $weekCalendar) {
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
     * @throws \Exception
     */
    protected function findDataDayWithDate($dayCalendar): DataDay
    {
        foreach ($this->getDataDays() as $dataDay) {
            if ($dataDay->toDateString() === $dayCalendar->toDateString()) {
                return $dataDay;
            }
        }

        //if month 08 and first day of week 29/07
        return new DataDay($dayCalendar);
    }
}
