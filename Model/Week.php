<?php
/**
 * Created by PhpStorm.
 * User: jfsenechal
 * Date: 25/03/19
 * Time: 20:25.
 */

namespace Grr\Core\Model;

use Carbon\Carbon;
use Carbon\CarbonInterface;
use Carbon\CarbonPeriod;
use Webmozart\Assert\Assert;

class Week
{
    /**
     * @var string
     */
    private static $language;
    /**
     * @var CarbonInterface
     */
    protected $first_day;
    /**
     * @var CarbonInterface
     */
    protected $last_day;

    public static function create(int $year, int $week, string $language): Week
    {
        Assert::greaterThan($year, 1970);
        Assert::greaterThan($week, 0);

        $date = Carbon::create($year);
        $date->setISODate($year, $week);
        $date->locale($language);
        self::$language = $language;

        $self = new self();

        $self->first_day = $date;
        $self->last_day = $date->copy()->endOfWeek();

        return $self;
    }

    /**
     * Retourne la liste des jours de la semaines.
     */
    public function getCalendarDays(): CarbonPeriod
    {
        $carbonPeriod = Carbon::parse($this->getFirstDay()->toDateString())->daysUntil(
            $this->getLastDay()->toDateString()
        );

        $carbonPeriod->locale(self::$language);

        return $carbonPeriod;
    }

    public function getFirstDay(): CarbonInterface
    {
        return $this->first_day;
    }

    public function getLastDay(): CarbonInterface
    {
        return $this->last_day;
    }
}
