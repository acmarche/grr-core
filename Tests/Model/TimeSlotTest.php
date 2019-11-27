<?php

namespace Grr\Core\Tests\Model;

use Grr\Core\Model\TimeSlot;
use Grr\Core\Tests\BaseTesting;
use Carbon\Carbon;

class TimeSlotTest extends BaseTesting
{
    public function testTimeSlot(): void
    {
        $begin = Carbon::create(2019, 10, 01, 9, 10);
        $end = Carbon::create(2019, 10, 01, 17, 00);

        $timeSlot = new TimeSlot($begin, $end);
        $timeSlot->getBegin();
        $timeSlot->getBegin();

        $this->assertSame($timeSlot->getBegin(), $begin);
        $this->assertSame($timeSlot->getEnd(), $end);
    }
}
