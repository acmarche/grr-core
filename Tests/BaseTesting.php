<?php
/**
 * This file is part of GrrSf application.
 *
 * @author jfsenechal <jfsenechal@gmail.com>
 * @date 20/08/19
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Grr\Core\Tests;

use DateTime;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\ORM\EntityManager;
use Grr\Core\Contrat\Entity\AreaInterface;
use Grr\Core\Contrat\Entity\EntryInterface;
use Grr\Core\Contrat\Entity\PeriodicityInterface;
use Grr\Core\Contrat\Entity\RoomInterface;
use Grr\Core\Contrat\Entity\Security\UserInterface;
use Grr\Core\Contrat\Entity\TypeEntryInterface;
use Grr\Core\Faker\CarbonFakerProvider;
use Grr\GrrBundle\Authorization\Helper\AuthorizationHelper;
use Grr\GrrBundle\User\Repository\UserRepository;
use Nelmio\Alice\Loader\NativeLoader;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpKernel\KernelInterface;

class BaseTesting extends WebTestCase
{
    protected ?EntityManager $entityManager = null;

    protected ?object $loader = null;

    protected NativeLoader $loaderSimple;

    protected string $pathFixtures;

    protected ?KernelInterface $kernel2 = null;

    protected KernelBrowser $administrator;

    protected KernelBrowser $bob;

    protected KernelBrowser $brenda;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        $this->kernel2 = self::bootKernel();

        $this->entityManager = $this->kernel2->getContainer()
            ->get('doctrine')
            ->getManager();

        $this->pathFixtures = $this->kernel2->getProjectDir().'/src/Grr/GrrBundle/src/Fixtures/';
        $this->loader = $this->kernel2->getContainer()->get('fidry_alice_data_fixtures.loader.doctrine');

        $loader = new NativeLoader();

        $faker = $loader->getFakerGenerator();
        $faker->addProvider(CarbonFakerProvider::class);

        $this->administrator = $this->createGrrClient('grr@domain.be');

        parent::setUp();
    }

    protected function createGrrClient(string $email, string $password = 'homer'): KernelBrowser
    {
        static::ensureKernelShutdown();

        return static::createClient(
            [],
            [
                'PHP_AUTH_USER' => $email,
                'PHP_AUTH_PW' => $password,
            ]
        );
    }

    protected function createAnonymousClient(): KernelBrowser
    {
        static::ensureKernelShutdown();

        return static::createClient();
    }

    protected function loginUser(string $username, string $password = 'homer'): KernelBrowser
    {
        static::ensureKernelShutdown();
        $client = static::createClient();
        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->loadByUserNameOrEmail($username);

        $client->loginUser($testUser);

        return $client;
    }

    protected function getArea(string $name): ?AreaInterface
    {
        return $this->entityManager
            ->getRepository(AreaInterface::class)
            ->findOneBy([
                'name' => $name,
            ]);
    }

    protected function getRoom(string $roomName): ?RoomInterface
    {
        return $this->entityManager
            ->getRepository(RoomInterface::class)
            ->findOneBy([
                'name' => $roomName,
            ]);
    }

    protected function getPeriodicity(int $type, string $endTime): ?PeriodicityInterface
    {
        $dateTime = DateTime::createFromFormat('Y-m-d', $endTime);

        return $this->entityManager
            ->getRepository(PeriodicityInterface::class)
            ->findOneBy([
                'type' => $type,
                'endTime' => $dateTime,
            ]);
    }

    protected function getEntry(string $name): ?EntryInterface
    {
        return $this->entityManager
            ->getRepository(EntryInterface::class)
            ->findOneBy([
                'name' => $name,
            ]);
    }

    protected function getUser(string $email): ?UserInterface
    {
        return $this->entityManager
            ->getRepository(UserInterface::class)
            ->findOneBy([
                'email' => $email,
            ]);
    }

    protected function getTypeEntry(string $name): ?TypeEntryInterface
    {
        return $this->entityManager
            ->getRepository(TypeEntryInterface::class)
            ->findOneBy([
                'name' => $name,
            ]);
    }

    protected function initSecurityHelper(): AuthorizationHelper
    {
        return self::getContainer()->get(AuthorizationHelper::class);
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        $purger = new ORMPurger($this->entityManager);
        //$purger->setPurgeMode(ORMPurger::PURGE_MODE_TRUNCATE);
        $purger->purge();

        $this->kernel2->shutdown();
        $this->kernel2 = null;

        $this->entityManager->close();
        $this->entityManager = null; // avoid memory leaks
    }
}
