<?php
/**
 * Created by PhpStorm.
 * User: jfsenechal
 * Date: 28/03/19
 * Time: 14:49.
 */

namespace Grr\Core\Model;

use Carbon\CarbonInterface;

class TimeSlot
{
    public function __construct(
        protected CarbonInterface $begin,
        protected CarbonInterface $end
    ) {
    }

    public function getBegin(): CarbonInterface
    {
        return $this->begin;
    }

    public function getEnd(): CarbonInterface
    {
        return $this->end;
    }
}
