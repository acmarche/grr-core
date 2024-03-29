<?php

namespace Grr\Core\Periodicity;

class PeriodicityConstant
{
    public const NONE = 0;

    public const EVERY_DAY = 1;

    public const EVERY_WEEK = 2;

    public const EVERY_YEAR = 4;

    public const EVERY_MONTH_SAME_DAY = 3;

    public const EVERY_MONTH_SAME_WEEK_DAY = 5;

    public const LIST_WEEKS_REPEAT = [
        1 => 'periodicity.every_week_repeat',
        2 => 'periodicity.every_week_repeat_2',
        3 => 'periodicity.every_week_repeat_3',
        4 => 'periodicity.every_week_repeat_4',
        5 => 'periodicity.every_week_repeat_5',
    ];

    /**
     * clef de type rep_type_0,rep_type_1,...
     *
     * @return string[]
     */
    public static function getTypesPeriodicite(): array
    {
        return [self::NONE => 'periodicity.type.none', self::EVERY_DAY => 'periodicity.type.everyday', self::EVERY_WEEK => 'periodicity.type.everyweek', self::EVERY_MONTH_SAME_DAY => 'periodicity.type.everymonth.sameday', self::EVERY_MONTH_SAME_WEEK_DAY => 'periodicity.type.everymonth.sameweek', self::EVERY_YEAR => 'periodicity.type.everyyear'];
    }

    public static function getTypePeriodicite(int $type): int|string
    {
        return self::getTypesPeriodicite()[$type] ?? $type;
    }
}
