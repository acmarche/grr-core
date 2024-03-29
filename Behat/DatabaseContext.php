<?php
/**
 * This file is part of GrrSf application.
 *
 * @author jfsenechal <jfsenechal@gmail.com>
 * @date 30/10/19
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Grr\Core\Behat;

use Behat\Behat\Context\Context;
use Symfony\Component\DependencyInjection\ContainerInterface;

class DatabaseContext implements Context
{
    private ?object $loader = null;

    private readonly string $pathFixtures;

    public function __construct(ContainerInterface $container)
    {
        $path = $container->getParameter('kernel.project_dir');
        $this->loader = $container->get('fidry_alice_data_fixtures.loader.doctrine');
        $this->pathFixtures = $path.'/src/Grr/GrrBundle/src/Fixtures/';
    }

    /**
     * @BeforeScenario
     */
    public function clearRepositories(): void
    {
        $files =
            [
                $this->pathFixtures.'area.yaml',
                $this->pathFixtures.'room.yaml',
                $this->pathFixtures.'entry_type.yaml',
                $this->pathFixtures.'user.yaml',
                $this->pathFixtures.'entry_today.yaml',
                $this->pathFixtures.'entry.yaml',
                $this->pathFixtures.'authorization.yaml',
            ];
        $this->loader->load($files);
    }

    /**
     * @AfterScenario
     */
    public function rollbackPostgreSqlTransaction(): void
    {
    }
}
