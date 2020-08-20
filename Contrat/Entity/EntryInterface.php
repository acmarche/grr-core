<?php
/**
 * This file is part of grr5 application.
 *
 * @author jfsenechal <jfsenechal@gmail.com>
 * @date 22/11/19
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Grr\Core\Contrat\Entity;

use DateTimeInterface;
use Grr\Core\Model\DurationModel;

interface EntryInterface
{
    public function getCellules(): int;

    public function setCellules(int $cellules): void;

    public function addLocation(array $location): void;

    public function getDuration(): ?DurationModel;

    public function setDuration(?DurationModel $duration): void;

    public function getArea(): ?AreaInterface;

    public function setArea(?AreaInterface $area): void;

    public function getLocations(): array;

    public function setLocations(array $locations): void;

    public function getStartTime(): ?DateTimeInterface;

    public function setStartTime(DateTimeInterface $startTime): void;

    public function getEndTime(): ?DateTimeInterface;

    public function setEndTime(DateTimeInterface $endTime): void;

    public function getCreatedBy(): ?string;

    public function setCreatedBy(string $createdBy): void;

    public function getDescription(): ?string;

    public function setDescription(?string $description): void;

    public function getStatutEntry(): ?string;

    public function setStatutEntry(?string $statutEntry): void;

    public function getOptionReservation(): ?int;

    public function setOptionReservation(int $optionReservation): void;

    public function getOverloadDesc(): ?string;

    public function setOverloadDesc(?string $overloadDesc): void;

    public function getModerate(): ?bool;

    public function setModerate(?bool $moderate): void;

    public function getPrivate(): ?bool;

    public function setPrivate(bool $private): void;

    public function getJours(): ?bool;

    public function setJours(bool $jours): void;

    public function getType(): ?TypeEntryInterface;

    public function setType(?TypeEntryInterface $type): void;

    public function getReservedFor(): ?string;

    public function setReservedFor(string $reservedFor): void;

    public function getId(): ?int;

    public function getName(): ?string;

    public function setName(string $name): void;

    public function getPeriodicity(): ?PeriodicityInterface;

    public function setPeriodicity(?PeriodicityInterface $periodicity): void;

    public function getRoom(): ?RoomInterface;

    public function setRoom(?RoomInterface $room): void;

    public function getCreatedAt(): DateTimeInterface;

    public function getUpdatedAt(): DateTimeInterface;

    public function setCreatedAt(DateTimeInterface $createdAt): void;

    public function setUpdatedAt(DateTimeInterface $updatedAt): void;
}
