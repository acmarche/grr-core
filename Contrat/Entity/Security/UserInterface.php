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
use Doctrine\Common\Collections\Collection;
use Grr\Core\Contrat\Entity\AreaInterface;
use Grr\Core\Contrat\Entity\RoomInterface;

interface UserInterface
{
    public function getId(): ?int;

    public function getName(): ?string;

    public function setName(string $name): void;

    public function getCreatedAt(): DateTimeInterface;

    public function getUpdatedAt(): DateTimeInterface;

    public function setCreatedAt(DateTimeInterface $createdAt): void;

    public function setUpdatedAt(DateTimeInterface $updatedAt): void;

    public function getUsername(): ?string;

    public function setUsername(string $username): void;

    public function addRole(string $role): void;

    public function removeRole(string $role): void;

    public function hasRole(string $role): bool;

    public function setRoles(array $roles): void;

    public function getPassword(): ?string;

    public function setPassword(?string $password): void;

    public function getEmail(): ?string;

    public function setEmail(string $email): void;

    public function getFirstName(): ?string;

    public function setFirstName(?string $first_name): void;

    public function getIsEnabled(): ?bool;

    public function setIsEnabled(bool $is_enabled): void;

    public function getAuthorizations(): Collection;

    public function addAuthorization(AuthorizationInterface $authorization): void;

    public function removeAuthorization(AuthorizationInterface $authorization): void;

    public function getLanguageDefault(): ?string;

    public function setLanguageDefault(?string $languageDefault): void;

    public function getArea(): ?AreaInterface;

    public function setArea(?AreaInterface $area): void;

    public function getRoom(): ?RoomInterface;

    public function setRoom(?RoomInterface $room): void;
}
