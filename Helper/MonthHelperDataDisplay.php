<?php
/**
 * Created by PhpStorm.
 * User: jfsenechal
 * Date: 20/03/19
 * Time: 16:21.
 */

namespace Grr\Core\Helper;

use Grr\Core\Contrat\Entity\AreaInterface;
use Grr\Core\Model\Month;
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
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function generateHtmlMonth(Month $month, AreaInterface $area): string
    {
        $weeks = $month->groupDataDaysByWeeks();

        return $this->environment->render(
            '@grr_front/monthly/_calendar_data.html.twig',
            [
                'listDays' => DateProvider::getNamesDaysOfWeek(),
                'firstDay' => $month->firstOfMonth(),
                'dataDays' => $month->getDataDays(),
                'weeks' => $weeks,
                'area' => $area, //for legend entry type
            ]
        );
    }
}
