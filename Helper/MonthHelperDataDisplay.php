<?php
/**
 * Created by PhpStorm.
 * User: jfsenechal
 * Date: 20/03/19
 * Time: 16:21.
 */

namespace Grr\Core\Helper;

use Carbon\Carbon;
use Grr\Core\Model\DataDay;
use Grr\Core\Provider\DateProvider;
use Twig\Environment;

class MonthHelperDataDisplay
{
    /**
     * @var Environment
     */
    private $environment;

    public function __construct(Environment $environment)
    {
        $this->environment = $environment;
    }

    /**
     * @param DataDay[] $dataDays
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function generateHtmlMonth(\DateTimeInterface $dateSelected, array $dataDays): string
    {
        $today = Carbon::instance($dateSelected);
        $weeks = DateProvider::weeksOfMonth($today);

        return $this->environment->render(
            '@grr_front/monthly/_calendar_data.html.twig',
            [
                'days' => DateProvider::getNamesDaysOfWeek(),
                'firstDay' => $today->firstOfMonth(),
                'dataDays' => $dataDays,
                'weeks' => $weeks,
            ]
        );
    }
}
