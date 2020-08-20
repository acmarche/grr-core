<?php
/**
 * This file is part of sf5 application.
 *
 * @author jfsenechal <jfsenechal@gmail.com>
 * @date 21/11/19
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Grr\Core\Contrat\Entity;

use Doctrine\Common\Collections\Collection;
use Grr\Core\Contrat\Entity\Security\AuthorizationInterface;

interface AreaInterface
{
    public function getOrderDisplay(): ?int;

    public function setOrderDisplay(int $orderDisplay): void;

    public function getStartTime(): ?int;

    public function setStartTime(int $startTime): void;

    public function getEndTime(): ?int;

    public function setEndTime(int $endTime): void;

    public function getWeekStart(): ?int;

    public function setWeekStart(int $weekStart): void;

    public function getIs24HourFormat(): ?bool;

    public function setIs24HourFormat(bool $is24HourFormat): void;

    public function getDaysOfWeekToDisplay(): ?array;

    public function setDaysOfWeekToDisplay(array $daysOfWeekToDisplay): void;

    public function getTimeInterval(): ?int;

    public function setTimeInterval(int $timeInterval): void;

    public function getDurationMaximumEntry(): ?int;

    public function setDurationMaximumEntry(int $durationMaximumEntry): void;

    public function getDurationDefaultEntry(): ?int;

    public function setDurationDefaultEntry(int $durationDefaultEntry): void;

    public function getMinutesToAddToEndTime(): ?int;

    public function setMinutesToAddToEndTime(int $minutesToAddToEndTime): void;

    public function getMaxBooking(): ?int;

    public function setMaxBooking(int $maxBooking): void;

    public function getIsRestricted(): ?bool;

    public function setIsRestricted(bool $isRestricted): void;

    public function getAuthorizations(): Collection;

    public function addAuthorization(AuthorizationInterface $authorization): void;

    public function removeAuthorization(AuthorizationInterface $authorization): void;

    public function getTypesEntry(): Collection;

    public function addTypeEntry(TypeEntryInterface $typeEntry): void;

    public function removeTypeEntry(TypeEntryInterface $typeEntry): void;

    public function getId(): ?int;

    public function getName(): ?string;

    public function setName(string $name): void;

    public function getRooms(): Collection;

    public function addRoom(RoomInterface $room): void;

    public function removeRoom(RoomInterface $room): void;
}
