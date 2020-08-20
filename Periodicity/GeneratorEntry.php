<?php

namespace Grr\Core\Periodicity;

use Carbon\Carbon;
use Carbon\CarbonInterface;
use Grr\Core\Contrat\Entity\EntryInterface;

class GeneratorEntry
{
    public function generateEntry(EntryInterface $entry, CarbonInterface $carbon): EntryInterface
    {
        $newEntry = clone $entry;

        $startTime = Carbon::instance($entry->getStartTime());
        $startTime->setYear($carbon->year);
        $startTime->setMonth($carbon->month);
        $startTime->setDay($carbon->day);

        $endTime = Carbon::instance($entry->getEndTime());
        $endTime->setYear($carbon->year);
        $endTime->setMonth($carbon->month);
        $endTime->setDay($carbon->day);

        $newEntry->setStartTime($startTime->toDateTime());
        $newEntry->setEndTime($endTime->toDateTime());

        return $newEntry;
    }
}
