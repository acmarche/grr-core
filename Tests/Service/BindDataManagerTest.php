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

use Grr\Core\Entry\EntryLocationService;
use Grr\Core\Factory\CarbonFactory;
use Grr\Core\Factory\DataDayFactory;
use Grr\Core\I18n\LocalHelper;
use Grr\Core\Model\Month;
use Grr\Core\Model\Week;
use Grr\Core\Provider\TimeSlotsProvider;
use Grr\Core\Tests\BaseTesting;
use Grr\GrrBundle\Entity\Entry;
use Grr\GrrBundle\Entity\Room;
use Grr\GrrBundle\Entry\Binder\BindDataManager;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Bundle\SecurityBundle\Security;

class BindDataManagerTest extends BaseTesting
{
    public function testBindMonthWithRoom(): void
    {
        $this->loadFixtures();

        $bindDataManager = $this->initBindDataManager();

        $monthModel = Month::init(2019, 12, 'fr');
        $area = $this->getArea('Hdv');
        $room = $this->getRoom('Salle Collège');

        $bindDataManager->bindMonth($monthModel, $area, $room);

        self::assertCount(31, $monthModel->getDataDays());
        foreach ($monthModel->getDataDays() as $dataDay) {
            self::assertCount(ResultBind::getCountEntriesFoMonthWithRoom($dataDay->day), $dataDay->getEntries());
            foreach ($dataDay->getEntries() as $entry) {
                self::assertContains($entry->getName(), ResultBind::resultNamesMonthWithRoom());
            }
        }
    }

    public function testBindMonthWithOutRoom(): void
    {
        $this->loadFixtures();

        $bindDataManager = $this->initBindDataManager();

        $monthModel = Month::init(2019, 12, 'fr');
        $area = $this->getArea('Hdv');

        $bindDataManager->bindMonth($monthModel, $area, null);

        self::assertCount(31, $monthModel->getDataDays());
        foreach ($monthModel->getDataDays() as $dataDay) {
            self::assertCount(ResultBind::getCountEntriesFoMonthWithOutRoom($dataDay->day), $dataDay->getEntries());
            foreach ($dataDay->getEntries() as $entry) {
                self::assertContains($entry->getName(), ResultBind::resultNamesMonthWithOutRoom());
            }
        }
    }

    public function testBindWeekWithRoom(): void
    {
        $this->loadFixtures();

        $bindDataManager = $this->initBindDataManager();

        $weekModel = Week::create(2018, 27, 'fr');

        $area = $this->getArea('Hdv');
        $room = $this->getRoom('Salle Conseil');

        $roomsModel = $bindDataManager->bindWeek($weekModel, $area, $room);

        foreach ($roomsModel as $roomModel) {
            foreach ($roomModel->getDataDays() as $dataDay) {
                self::assertContains($dataDay->format('Y-m-d'), ResultBind::getDaysOfWeekWithRoom());
                self::assertCount(ResultBind::getCountEntriesForWeekWithMonth($dataDay->day), $dataDay->getEntries());
                foreach ($dataDay->getEntries() as $entry) {
                    self::assertContains($entry->getName(), ResultBind::resultNamesWeekWithRoom());
                }
            }
        }
    }

    public function testBindWeekWithOutRoom(): void
    {
        $this->loadFixtures();

        $bindDataManager = $this->initBindDataManager();

        $weekModel = Week::create(2019, 49, 'fr'); //2 december to 8 december

        $area = $this->getArea('Hdv');
        $roomsModel = $bindDataManager->bindWeek($weekModel, $area, null);

        self::assertCount(3, $roomsModel);

        foreach ($roomsModel as $roomModel) {
            foreach ($roomModel->getDataDays() as $dataDay) {
                self::assertContains($dataDay->format('Y-m-d'), ResultBind::getDaysOfWeekWitOuthhRoom());
                self::assertCount(
                    ResultBind::getCountEntriesForWeekWithOutMonth($dataDay->day, $roomModel->getRoom()->getName()),
                    $dataDay->getEntries()
                );
                foreach ($dataDay->getEntries() as $entry) {
                    self::assertContains($entry->getName(), ResultBind::resultNamesWeekWithOutRoom());
                }
            }
        }
    }

    public function testBindDayWithOutRoom(): void
    {
        $this->loadFixtures();

        $dayModel = $this->initDayFactory()->createImmutable(2019, 12, 5);
        $daySelected = $dayModel->toImmutable();

        $timeSlotsProvider = $this->initTimeSlotProvider();
        $area = $this->getArea('Hdv');
        $bindDataManager = $this->initBindDataManager();

        $hoursModel = $timeSlotsProvider->getTimeSlotsByAreaAndDaySelected($area, $daySelected);
        $roomsModel = $bindDataManager->bindDay($daySelected, $area, $hoursModel, null);

        self::assertCount(3, $roomsModel);

        foreach ($roomsModel as $roomModel) {
            foreach ($roomModel->getDataDays() as $dataDay) {
                self::assertContains($dataDay->format('Y-m-d'), ResultBind::getDaysOfWeekWitOuthhRoom());
                self::assertCount(
                    ResultBind::getCountEntriesForWeekWithOutMonth($dataDay->day, $roomModel->getRoom()->getName()),
                    $dataDay->getEntries()
                );
                foreach ($dataDay->getEntries() as $entry) {
                    self::assertContains($entry->getName(), ResultBind::resultNamesWeekWithOutRoom());
                }
            }
        }
    }

    protected function loadFixtures(): void
    {
        $files =
            [
                $this->pathFixtures.'area.yaml',
                $this->pathFixtures.'room.yaml',
                $this->pathFixtures.'entry_type.yaml',
                $this->pathFixtures.'periodicity.yaml',
                $this->pathFixtures.'entry_with_periodicity.yaml',
            ];

        $this->loader->load($files);
    }

    protected function initTimeSlotProvider(): TimeSlotsProvider
    {
        $parameterBag = $this->createMock(ParameterBagInterface::class);
        $requestStack = $this->createMock(RequestStack::class);
        $security = $this->createMock(Security::class);
        $localHelper = new LocalHelper($parameterBag, $security, $requestStack);
        $carbonFactory = new CarbonFactory($localHelper);

        return new TimeSlotsProvider($carbonFactory);
    }

    protected function initDayFactory(): DataDayFactory
    {
        $parameterBag = $this->createMock(ParameterBagInterface::class);
        $requestStack = $this->createMock(RequestStack::class);
        $security = $this->createMock(Security::class);
        $localHelper = new LocalHelper($parameterBag, $security, $requestStack);
        $carbonFactory = new CarbonFactory($localHelper);

        return new DataDayFactory($carbonFactory, $localHelper);
    }

    private function initLocationService(): EntryLocationService
    {
        return new EntryLocationService($this->initTimeSlotProvider());
    }

    private function initBindDataManager(): BindDataManager
    {
        $entryRepository = $this->entityManager->getRepository(Entry::class);
        $roomRepository = $this->entityManager->getRepository(Room::class);
        $dayFactory = $this->initDayFactory();
        $entryLocationService = $this->initLocationService();

        return new BindDataManager(
            $entryRepository,
            $roomRepository,
            $entryLocationService,
            $dayFactory
        );
    }
}
