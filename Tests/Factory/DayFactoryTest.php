<?php
/**
 * This file is part of GrrSf application.
 *
 * @author jfsenechal <jfsenechal@gmail.com>
 * @date 20/08/19
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Grr\Core\Tests\Factory;

use Carbon\Carbon;
use Doctrine\Common\Collections\ArrayCollection;
use Grr\Core\Factory\CarbonFactory;
use Grr\Core\Factory\DataDayFactory;
use Grr\Core\I18n\LocalHelper;
use Grr\Core\Model\Day;
use Grr\Core\Tests\BaseTesting;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Security;

class DayFactoryTest extends BaseTesting
{
    /**
     * @var DataDayFactory
     */
    private $dayFactory;

    protected function setUp(): void
    {
        parent::setUp();
        $parameterBag = $this->createMock(ParameterBagInterface::class);
        $requestStack = $this->createMock(RequestStack::class);
        $security = $this->createMock(Security::class);
        $localHelper = new LocalHelper($parameterBag, $security, $requestStack);
        $carbonFactory = new CarbonFactory($localHelper);
        $this->dayFactory = new DataDayFactory($carbonFactory, $localHelper);
    }

    public function testCreateImmutable(): void
    {
        $day = $this->dayFactory->createImmutable(2019, 10, 1);
        $this->assertInstanceOf(Day::class, $day);
        $this->assertInstanceOf(ArrayCollection::class, $day->getEntries());
    }

    public function testCreateFromCarbon(): void
    {
        $carbon = Carbon::today();
        $day = $this->dayFactory->createFromCarbon($carbon);
        $this->assertInstanceOf(Day::class, $day);
        $this->assertInstanceOf(ArrayCollection::class, $day->getEntries());
    }
}
