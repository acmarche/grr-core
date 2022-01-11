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

interface PeriodicityInterface
{
    public function getEntries(): iterable;

    public function addEntry(EntryInterface $entry): void;

    public function removeEntry(EntryInterface $entry): void;

    public function getId(): ?int;

    public function getEntryReference(): ?EntryInterface;

    public function setEntryReference(?EntryInterface $entry): void;

    public function getEndTime(): ?DateTimeInterface;

    public function setEndTime(DateTimeInterface $dateTime): void;

    public function getType(): ?int;

    public function setType(int $type): void;

    public function getWeekRepeat(): ?int;

    public function setWeekRepeat(?int $weekRepeat): void;

    public function getWeekDays(): ?array;

    public function setWeekDays(?array $weekDays): void;
}
