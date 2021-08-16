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

interface RoomInterface
{
    public function getArea(): ?AreaInterface;

    public function setArea(?AreaInterface $area): void;

    public function getAuthorizations(): iterable;

    public function addAuthorization(AuthorizationInterface $authorization): void;

    public function removeAuthorization(AuthorizationInterface $authorization): void;

    public function getEntries(): iterable;

    public function addEntry(EntryInterface $entry): void;

    public function removeEntry(EntryInterface $entry): void;

    public function getId(): ?int;

    public function getName(): ?string;

    public function setName(string $name): void;

    public function getDescription(): ?string;

    public function setDescription(?string $description): void;

    public function getCapacity(): ?int;

    public function setCapacity(int $capacity): void;

    public function getMaximumBooking(): ?int;

    public function setMaximumBooking(int $maximumBooking): void;

    public function getStatutRoom(): ?bool;

    public function setStatutRoom(bool $statutRoom): void;

    public function getShowFicRoom(): ?bool;

    public function setShowFicRoom(bool $showFicRoom): void;

    public function getPictureRoom(): ?string;

    public function setPictureRoom(?string $pictureRoom): void;

    public function getCommentRoom(): ?string;

    public function setCommentRoom(?string $commentRoom): void;

    public function getShowComment(): ?bool;

    public function setShowComment(bool $showComment): void;

    public function getDelaisMaxResaRoom(): ?int;

    public function setDelaisMaxResaRoom(int $delaisMaxResaRoom): void;

    public function getDelaisMinResaRoom(): ?int;

    public function setDelaisMinResaRoom(int $delaisMinResaRoom): void;

    public function getAllowActionInPast(): ?bool;

    public function setAllowActionInPast(bool $allowActionInPast): void;

    public function getOrderDisplay(): ?int;

    public function setOrderDisplay(int $orderDisplay): void;

    public function getDelaisOptionReservation(): ?int;

    public function setDelaisOptionReservation(int $delaisOptionReservation): void;

    public function getDontAllowModify(): bool;

    public function setDontAllowModify(bool $dontAllowModify): void;

    public function getTypeAffichageReser(): ?int;

    public function setTypeAffichageReser(int $typeAffichageReser): void;

    public function getModerate(): ?bool;

    public function setModerate(?bool $moderate): void;

    public function getQuiPeutReserverPour(): ?string;

    public function setQuiPeutReserverPour(string $quiPeutReserverPour): void;

    public function getActiveRessourceEmpruntee(): ?bool;

    public function setActiveRessourceEmpruntee(bool $activeRessourceEmpruntee): void;

    public function getRuleToAdd(): ?int;

    public function setRuleToAdd(int $ruleToAdd): void;
}
