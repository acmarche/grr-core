<?php
/**
 * This file is part of GrrSf application.
 *
 * @author jfsenechal <jfsenechal@gmail.com>
 * @date 24/09/19
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Grr\Core\Router;

use Carbon\Carbon;
use Grr\Core\Contrat\Entity\EntryInterface;
use Grr\Core\Contrat\Front\ViewInterface;
use Symfony\Component\Routing\RouterInterface;

class FrontRouterHelper
{
    private RouterInterface $router;

    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    public function generateMonthView(EntryInterface $entry, bool $withRoom = false): string
    {
        $room = $entry->getRoom();
        $area = $room->getArea();

        $date = Carbon::instance($entry->getStartTime());

        $params = ['area' => $area->getId(), 'date' => $date, 'view' => ViewInterface::VIEW_MONTHLY];

        if ($withRoom) {
            $params['room'] = $room->getId();
        }

        return $this->router->generate('grr_front_view', $params);
    }
}
