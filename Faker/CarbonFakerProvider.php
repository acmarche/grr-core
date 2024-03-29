<?php
/**
 * This file is part of GrrSf application.
 *
 * @author jfsenechal <jfsenechal@gmail.com>
 * @date 22/08/19
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Grr\Core\Faker;

use Carbon\Carbon;
use Carbon\CarbonImmutable;
use DateTime;
use DateTimeImmutable;
use Faker\Provider\Base as BaseProvider;

/**
 * Util pour le chargement des fixtures lors des tests
 * Class CarbonProvider.
 */
class CarbonFakerProvider extends BaseProvider
{
    /**
     * @return DateTime|DateTimeImmutable
     */
    public function carbonDateTime(int $year, int $month, int $day, int $hour, int $minute): DateTime
    {
        return Carbon::create($year, $month, $day, $hour, $minute)->toDateTime();
    }

    /**
     * @return DateTime|DateTimeImmutable
     */
    public function carbonDate(int $year, int $month, int $day): DateTime
    {
        return Carbon::createFromDate($year, $month, $day)->toDateTime();
    }

    public function carbonFromFormat(string $format, string $date): bool|CarbonImmutable
    {
        return CarbonImmutable::createFromFormat($format, $date);
    }

    public function carbonToday(int $hour, int $minute): Carbon
    {
        $today = Carbon::today();
        $today->setTime($hour, $minute);

        return $today;
    }
}
