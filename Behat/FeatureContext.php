<?php
/**
 * This file is part of GrrSf application.
 *
 * @author jfsenechal <jfsenechal@gmail.com>
 * @date 21/10/19
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Grr\Core\Behat;

use Behat\MinkExtension\Context\RawMinkContext;
use Carbon\Carbon;
use Exception;
use Grr\Core\Contrat\Front\ViewInterface;
use Grr\GrrBundle\Area\Repository\AreaRepository;
use Grr\GrrBundle\Entry\Repository\EntryRepository;
use RuntimeException;

class FeatureContext //extends RawMinkContext
{
    public function __construct(
        private readonly EntryRepository $entryRepository,
        private readonly AreaRepository $areaRepository
    ) {
    }

    public function getSymfonyProfile()
    {
        $driver = $this->getSession()->getDriver();

        $profile = $driver->getClient()->getProfile();
        var_dump($profile);
        if (false === $profile) {
            throw new RuntimeException('The profiler is disabled. Activate it by setting framework.profiler.only_exceptions to false in '.'your config');
        }

        return $profile;
    }

    /**
     * @Given I am logged in as an admin
     */
    public function iAmLoggedInAsAnAdmin(): void
    {
        $this->visitPath('/fr/login');
        //var_dump($this->getSession()->getPage()->getContent());
        $this->fillField('username', 'grr@domain.be');
        $this->fillField('password', 'homer');
        $this->pressButton("S'identifier");
    }

    /**
     * iven I am logged in as user :username.
     *
     * @Given /^I am logged in as user "([^"]*)"$/
     */
    public function iAmLoggedInAsUser(string $username): void
    {
        $this->visitPath('/fr/login');
        $this->fillField('username', $username);
        $this->fillField('password', 'homer');
        $this->pressButton("S'identifier");
    }

    /**
     * @Given I fill the periodicity endTime with the date :day/:month/:year
     */
    public function iFillEndTimePeridocity(int $day, int $month, int $year): void
    {
        $this->fillField('entry_with_periodicity[periodicity][endTime][day]', $day);
        $this->fillField('entry_with_periodicity[periodicity][endTime][month]', $month);
        $this->fillField('entry_with_periodicity[periodicity][endTime][year]', $year);
    }

    /**
     * @Given /^I fill the periodicity endTime with this month and day (\d+) and year (\d+)$/
     */
    public function iFillEndTimePeridocityThisMonth(int $day, int $year): void
    {
        $today = Carbon::today();

        $this->fillField('entry_with_periodicity[periodicity][endTime][day]', $day);
        $this->fillField('entry_with_periodicity[periodicity][endTime][month]', $today->month);
        $this->fillField('entry_with_periodicity[periodicity][endTime][year]', $year);
    }

    /**
     * @Given I fill the periodicity endTime with later date
     */
    public function iFillEndTimePeridocityLater(): void
    {
        $today = Carbon::today();
        $today->addDays(3);

        $this->fillField('entry_with_periodicity[periodicity][endTime][day]', $today->day);
        $this->fillField('entry_with_periodicity[periodicity][endTime][month]', $today->month);
        $this->fillField('entry_with_periodicity[periodicity][endTime][year]', $today->year);
    }

    /**
     * @Given I fill the entry startTime with the date :day/:month/:year
     */
    public function iFillDateBeginEntry(int $day, int $month, int $year): void
    {
        $this->fillField('entry_with_periodicity_startTime_date_day', $day);
        $this->fillField('entry_with_periodicity_startTime_date_month', $month);
        $this->fillField('entry_with_periodicity_startTime_date_year', $year);
    }

    /**
     * @Given I fill the entry startTime with today :hour::minute
     */
    public function iFillDateBeginEntryWithToday(int $hour, int $minute): void
    {
        $today = Carbon::today();
        $this->fillField('entry_with_periodicity_startTime_date_day', $today->day);
        $this->fillField('entry_with_periodicity_startTime_date_month', $today->month);
        $this->fillField('entry_with_periodicity_startTime_date_year', $today->year);
        $this->fillField('entry_with_periodicity_startTime_time_hour', $hour);
        $this->fillField('entry_with_periodicity_startTime_time_minute', $minute);
    }

    /**
     * @Given /^I fill the entry startTime with this month and day (\d+) and year (\d+) at time (\d+):(\d+)$/
     */
    public function iFillDateBeginEntryWithThisMonth(int $day, int $year, int $hour, int $minute): void
    {
        $today = Carbon::today();
        $this->fillField('entry_with_periodicity_startTime_date_day', $day);
        $this->fillField('entry_with_periodicity_startTime_date_month', $today->month);
        $this->fillField('entry_with_periodicity_startTime_date_year', $year);
        $this->fillField('entry_with_periodicity_startTime_time_hour', $hour);
        $this->fillField('entry_with_periodicity_startTime_time_minute', $minute);
    }

    /**
     * Clicks link semaine
     * Example: When I follow this week.
     *
     * @Then /^I follow this week$/
     */
    public function clickLinkWeek(): void
    {
        $link = 's'.Carbon::today()->week;
        $link = $this->fixStepArgument($link);
        $this->getSession()->getPage()->clickLink($link);
    }

    /**
     * Clicks link day
     * Example: When I follow this day.
     *
     * @Then /^I follow this day$/
     */
    public function clickLinkDay(): void
    {
        $link = Carbon::today()->day;
        $link = $this->fixStepArgument($link);
        $this->getSession()->getPage()->clickLink($link);
    }

    /**
     * @Then /^I should see "([^"]*)" exactly "([^"]*)" times$/
     *
     * @throws Exception
     */
    public function iShouldSeeTextSoManyTimes(string $sText, string $iExpected): void
    {
        $sContent = $this->getSession()->getPage()->getText();
        $iFound = substr_count((string) $sContent, (string) $sText);
        if ($iExpected != $iFound) {
            throw new Exception('Found '.$iFound.' occurences of "'.$sText.'" when expecting '.$iExpected);
        }
    }

    /**
     * @Given /^I am on the page show entry "([^"]*)"$/
     */
    public function iAmOnThePageShowEntry(string $name): void
    {
        $entry = $this->entryRepository->findOneBy([
            'name' => $name,
        ]);
        $path = '/fr/front/entry/'.$entry->getId();
        $this->visitPath($path);
    }

    /**
     * @Given /^I am on the page month view at "([^"]*)" and area "([^"]*)"$/
     */
    public function iAmOnThePageMonthView(string $date, string $areaName): void
    {
        $area = $this->areaRepository->findOneBy([
            'name' => $areaName,
        ]);
        $path = '/fr/front/area/'.$area->getId().'/date/'.$date.'/view/'.ViewInterface::VIEW_MONTHLY.'/room';
        $this->visitPath($path);
    }

    private function fillField(string $field, string $value): void
    {
        $this->getSession()->getPage()->fillField($field, $value);
    }

    private function pressButton(string $button): void
    {
        $button = $this->fixStepArgument($button);
        $this->getSession()->getPage()->pressButton($button);
    }

    protected function fixStepArgument($argument): array|string
    {
        return str_replace('\\"', '"', (string) $argument);
    }
}
