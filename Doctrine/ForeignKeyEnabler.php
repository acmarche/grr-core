<?php
/**
 * This file is part of GrrSf application.
 *
 * @author jfsenechal <jfsenechal@gmail.com>
 * @date 27/08/19
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Grr\Core\Doctrine;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query\ResultSetMapping;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

/**
 * We enable foreign keys manually/specifically in the test environment as SQLite does not have them enabled by default.
 *
 * @see https://tomnewby.net/
 */
class ForeignKeyEnabler //implements EventSubscriber
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private ParameterBagInterface $parameterBag
    ) {
    }

    /**
     * @return string[]
     */
    public function getSubscribedEvents(): array
    {
        $env = $this->parameterBag->get('kernel.environment');

        return [
            'preFlush',
        ];
    }

    public function preFlush(): void
    {
        $this->entityManager
            ->createNativeQuery('PRAGMA foreign_keys = ON;', new ResultSetMapping())
            ->execute();
    }
}
