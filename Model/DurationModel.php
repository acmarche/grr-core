<?php

namespace Grr\Core\Model;

class DurationModel
{
    public const UNIT_TIME_MINUTES = 1;
    public const UNIT_TIME_HOURS = 2;
    public const UNIT_TIME_DAYS = 3;
    public const UNIT_TIME_WEEKS = 4;

    /**
     * Unité de temps.
     */
    private int $unit;

    /**
     * Le temps en flottant.
     *
     * @var float;
     */
    private float $time;

    private bool $full_day;

    /**
     * Encodage de la date de fin de l'entry.
     *
     * @return string[]
     */
    public static function getUnitsTime(): array
    {
        return [
            self::UNIT_TIME_MINUTES => 'unit.minutes',
            self::UNIT_TIME_HOURS => 'unit.hours',
            self::UNIT_TIME_DAYS => 'unit.days',
            self::UNIT_TIME_WEEKS => 'unit.weeks',
        ];
    }

    public function __construct()
    {
        $this->full_day = false;
        $this->time = 0;
        $this->unit = self::UNIT_TIME_MINUTES;
    }

    public function getUnit(): int
    {
        return $this->unit;
    }

    /**
     * @return DurationModel
     */
    public function setUnit(int $unit): void
    {
        $this->unit = $unit;
    }

    public function getTime(): float
    {
        return $this->time;
    }

    /**
     * @return DurationModel
     */
    public function setTime(float $time): void
    {
        $this->time = $time;
    }

    public function isFullDay(): bool
    {
        return $this->full_day;
    }

    /**
     * @return DurationModel
     */
    public function setFullDay(bool $full_day): void
    {
        $this->full_day = $full_day;
    }
}
