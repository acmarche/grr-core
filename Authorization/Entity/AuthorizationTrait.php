<?php

namespace Grr\Core\Authorization\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Grr\Core\Contrat\Entity\AreaInterface;
use Grr\Core\Contrat\Entity\RoomInterface;
use Grr\Core\Contrat\Entity\Security\UserInterface;
use Grr\Core\Doctrine\Traits\IdEntityTrait;
use Knp\DoctrineBehaviors\Model\Timestampable\TimestampableTrait;

trait AuthorizationTrait
{
    use IdEntityTrait;
    use TimestampableTrait;

    #[ORM\ManyToOne(targetEntity: UserInterface::class, inversedBy: 'authorizations')]
    #[ORM\JoinColumn(nullable: false)]
    private UserInterface $user;

    #[ORM\ManyToOne(targetEntity: AreaInterface::class, inversedBy: 'authorizations')]
    #[ORM\JoinColumn(nullable: true)]
    private ?AreaInterface $area = null;

    #[ORM\ManyToOne(targetEntity: RoomInterface::class, inversedBy: 'authorizations')]
    #[ORM\JoinColumn(nullable: true)]
    private ?RoomInterface $room = null;

    #[ORM\Column(type: 'boolean')]
    private bool $isAreaAdministrator;

    #[ORM\Column(type: 'boolean')]
    private bool $isResourceAdministrator;

    public function __construct()
    {
        $this->createdAt = new DateTime();
        $this->updatedAt = new DateTime();
        $this->isAreaAdministrator = false;
        $this->isResourceAdministrator = false;
    }

    public function __toString(): string
    {
        return '';
    }

    public function getIsAreaAdministrator(): ?bool
    {
        return $this->isAreaAdministrator;
    }

    public function setIsAreaAdministrator(bool $isAreaAdministrator): void
    {
        $this->isAreaAdministrator = $isAreaAdministrator;
    }

    public function getIsResourceAdministrator(): ?bool
    {
        return $this->isResourceAdministrator;
    }

    public function setIsResourceAdministrator(bool $isResourceAdministrator): void
    {
        $this->isResourceAdministrator = $isResourceAdministrator;
    }

    public function getUser(): ?UserInterface
    {
        return $this->user;
    }

    public function setUser(?UserInterface $user): void
    {
        $this->user = $user;
    }

    public function getArea(): ?AreaInterface
    {
        return $this->area;
    }

    public function setArea(?AreaInterface $area): void
    {
        $this->area = $area;
    }

    public function getRoom(): ?RoomInterface
    {
        return $this->room;
    }

    public function setRoom(?RoomInterface $room): void
    {
        $this->room = $room;
    }
}
