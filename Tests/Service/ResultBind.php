<?php
/**
 * This file is part of GrrSf application.
 *
 * @author jfsenechal <jfsenechal@gmail.com>
 * @date 23/08/19
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Grr\Core\Tests\Service;

class ResultBind
{
    /**
     * @return string[]
     */
    public static function resultNamesMonthWithRoom(): array
    {
        return [
            'Tous les jours pendant 3 jours',
        ];
    }

    /**
     * @return string[]
     */
    public static function resultNamesMonthWithOutRoom(): array
    {
        return [
            'Tous les jours pendant 3 jours',
            'Entry avec une date en commun autre room',
        ];
    }

    /**
     * 2019-12-02 => 2019-12-03, 2019-12-04, 2019-12-05.
     */
    public static function getCountEntriesFoMonthWithRoom(int $day): int
    {
        $result = [
            2 => 1,
            3 => 1,
            4 => 1,
            5 => 1,
        ];

        return $result[$day] ?? 0;
    }

    /**
     * 2019-12-02 => 2019-12-03, 2019-12-04, 2019-12-05
     * 2019-12-03 => 2019-12-04, 2019-12-05, 2019-12-06.
     */
    public static function getCountEntriesFoMonthWithOutRoom(int $day): int
    {
        $result = [
            2 => 1,
            3 => 2,
            4 => 2,
            5 => 2,
            6 => 1,
        ];

        return $result[$day] ?? 0;
    }

    public static function getDaysOfWeekWithRoom(): array
    {
        return [
            '2018-07-02',
            '2018-07-03',
            '2018-07-04',
            '2018-07-05',
            '2018-07-06',
            '2018-07-07',
            '2018-07-08',
        ];
    }

    public static function getDaysOfWeekWitOuthhRoom(): array
    {
        return [
            '2019-12-02',
            '2019-12-03',
            '2019-12-04',
            '2019-12-05',
            '2019-12-06',
            '2019-12-07',
            '2019-12-08',
        ];
    }

    public static function getCountEntriesForWeekWithMonth(int $day): int
    {
        $result = [
            2 => 1,
            3 => 1,
        ];

        return $result[$day] ?? 0;
    }

    /**
     * 2019-12-02 => 2019-12-03, 2019-12-04, 2019-12-05
     * 2019-12-03 => 2019-12-04, 2019-12-05, 2019-12-06.
     */
    public static function getCountEntriesForWeekWithOutMonth(int $day, string $room): int
    {
        $result = [];
        $result['Salle Collège'][2] = 1;
        $result['Salle Collège'][3] = 1;
        $result['Salle Collège'][4] = 1;
        $result['Salle Collège'][5] = 1;
        $result['Salle Conseil'][3] = 1;
        $result['Salle Conseil'][4] = 1;
        $result['Salle Conseil'][5] = 1;
        $result['Salle Conseil'][6] = 1;

        return $result[$room][$day] ?? 0;
    }

    /**
     * @return string[]
     */
    public static function resultNamesWeekWithRoom(): array
    {
        return [
            'Toutes les semaines, lundi et mardi',
        ];
    }

    /**
     * @return string[]
     */
    public static function resultNamesWeekWithOutRoom(): array
    {
        return [
            'Tous les jours pendant 3 jours',
            'Entry avec une date en commun autre room',
        ];
    }
}
