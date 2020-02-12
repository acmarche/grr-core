<?php
/**
 * This file is part of grr5 application.
 *
 * @author jfsenechal <jfsenechal@gmail.com>
 * @date 21/11/19
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Grr\Core\Contrat\Entity\Security;

use DateTimeInterface;
use Grr\Core\Contrat\Entity\AreaInterface;
use Grr\Core\Contrat\Entity\RoomInterface;

interface AuthorizationInterface
{
    public function getIsAreaAdministrator(): ?bool;

    public function setIsAreaAdministrator(bool $isAreaAdministrator): void;

    public function getIsResourceAdministrator(): ?bool;

    public function setIsResourceAdministrator(bool $isResourceAdministrator): void;

    public function getUser(): ?UserInterface;

    public function setUser(?UserInterface $user): void;

    public function getArea(): ?AreaInterface;

    public function setArea(?AreaInterface $area): void;

    public function getRoom(): ?RoomInterface;

    public function setRoom(?RoomInterface $room): void;

    public function getId(): ?int;

    public function getCreatedAt(): DateTimeInterface;

    public function getUpdatedAt(): DateTimeInterface;

    public function setCreatedAt(DateTimeInterface $createdAt): void;

    public function setUpdatedAt(DateTimeInterface $updatedAt): void;
}
