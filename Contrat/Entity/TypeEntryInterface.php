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

use Doctrine\Common\Collections\Collection;

interface TypeEntryInterface
{
    public function getEntries(): Collection;

    public function addEntry(EntryInterface $entry): void;

    public function removeEntry(EntryInterface $entry): void;

    public function getOrderDisplay(): ?int;

    public function setOrderDisplay(int $orderDisplay): void;

    public function getColor(): ?string;

    public function setColor(?string $color): void;

    public function getLetter(): ?string;

    public function setLetter(string $letter);

    public function getAvailable(): int;

    public function setAvailable(int $available): void;

    public function getId(): ?int;

    public function getName(): ?string;

    public function setName(string $name): void;
}
