<?php
/**
 * Created by PhpStorm.
 * User: jfsenechal
 * Date: 1/03/19
 * Time: 17:42.
 */

namespace Grr\Core\Factory;

use Carbon\Carbon;
use DateTimeInterface;
use Grr\Core\Contrat\Entity\EntryInterface;
use Grr\Core\Model\DurationModel;
use Grr\Core\Service\TimeService;

class DurationFactory
{
    public function createNew(): DurationModel
    {
        return new DurationModel();
    }

    public function createByEntry(EntryInterface $entry): DurationModel
    {
        $durationModel = $this->createFromDates($entry->getStartTime(), $entry->getEndTime());
        $this->setFullDay($entry, $durationModel);

        return $durationModel;
    }

    public function createFromDates(DateTimeInterface $startTime, DateTimeInterface $endTime): DurationModel
    {
        $durationModel = $this->createNew();

        $this->setUnitAndTime($durationModel, $startTime, $endTime);

        return $durationModel;
    }

    protected function setUnitAndTime(
        DurationModel $durationModel,
        DateTimeInterface $startDateTime,
        DateTimeInterface $endDateTime
    ): void {
        $startTime = Carbon::instance($startDateTime);
        $endTime = Carbon::instance($endDateTime);

        $minutes = $startTime->diffInMinutes($endTime);
        $hours = $startTime->diffInRealHours($endTime);
        $days = $startTime->diffInDays($endTime);
        $weeks = $startTime->diffInWeeks($endTime);

        if ($minutes > 0) {
            $durationModel->setUnit(DurationModel::UNIT_TIME_MINUTES);
            $durationModel->setTime($minutes);
        }
        if ($hours > 0) {
            $durationModel->setUnit(DurationModel::UNIT_TIME_HOURS);
            $hour = TimeService::convertMinutesToHour($hours, $minutes);
            $durationModel->setTime($hour);
        }
        if ($days > 0) {
            $durationModel->setUnit(DurationModel::UNIT_TIME_DAYS);
            $durationModel->setTime($days);
        }
        if ($weeks > 0) {
            $durationModel->setUnit(DurationModel::UNIT_TIME_WEEKS);
            $durationModel->setTime($weeks);
        }
    }

    private function setFullDay(EntryInterface $entry, DurationModel $durationModel): void
    {
        $area = $entry->getRoom()->getArea();

        if ($area->getStartTime() === (int) $entry->getStartTime()->format('G') && $area->getEndTime(
            ) === (int) $entry->getEndTime()->format('G')) {
            $durationModel->setFullDay(true);
        }
    }
}
