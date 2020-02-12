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

    /**
     * @ORM\ManyToOne(targetEntity="Grr\Core\Contrat\Entity\Security\UserInterface", inversedBy="authorizations")
     * @ORM\JoinColumn(nullable=false)
     *
     * @var UserInterface
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="Grr\Core\Contrat\Entity\AreaInterface", inversedBy="authorizations")
     * @ORM\JoinColumn(nullable=true)
     *
     * @var AreaInterface|null
     */
    private $area;

    /**
     * @ORM\ManyToOne(targetEntity="Grr\Core\Contrat\Entity\RoomInterface", inversedBy="authorizations")
     * @ORM\JoinColumn(nullable=true)
     *
     * @var RoomInterface|null
     */
    private $room;

    /**
     * @var bool
     * @ORM\Column(type="boolean")
     */
    private $isAreaAdministrator;

    /**
     * @var bool
     * @ORM\Column(type="boolean")
     */
    private $isResourceAdministrator;

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

        return $this;
    }

    public function getIsResourceAdministrator(): ?bool
    {
        return $this->isResourceAdministrator;
    }

    public function setIsResourceAdministrator(bool $isResourceAdministrator): void
    {
        $this->isResourceAdministrator = $isResourceAdministrator;

        return $this;
    }

    public function getUser(): ?UserInterface
    {
        return $this->user;
    }

    public function setUser(?UserInterface $user): void
    {
        $this->user = $user;

        return $this;
    }

    public function getArea(): ?AreaInterface
    {
        return $this->area;
    }

    public function setArea(?AreaInterface $area): void
    {
        $this->area = $area;

        return $this;
    }

    public function getRoom(): ?RoomInterface
    {
        return $this->room;
    }

    public function setRoom(?RoomInterface $room): void
    {
        $this->room = $room;

        return $this;
    }
}
