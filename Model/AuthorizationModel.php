<?php

namespace Grr\Core\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Grr\Core\Contrat\Entity\AreaInterface;
use Grr\Core\Contrat\Entity\RoomInterface;
use Grr\Core\Contrat\Entity\Security\UserInterface;

class AuthorizationModel
{
    /**
     * @var AreaInterface|null
     */
    protected $area;

    /**
     * @var RoomInterface[]|array|ArrayCollection
     */
    protected $rooms;

    /**
     * @var UserInterface[]|array
     */
    protected $users;

    /**
     * @var int|null
     */
    private $role;

    public function __construct()
    {
        $this->users = [];
        $this->rooms = new ArrayCollection();
    }

    public function getArea(): ?AreaInterface
    {
        return $this->area;
    }

    public function setArea(?AreaInterface $area): void
    {
        $this->area = $area;
    }

    /**
     * @return RoomInterface[]
     */
    public function getRooms(): ArrayCollection
    {
        return $this->rooms;
    }

    /**
     * @param RoomInterface[]|array $rooms
     */
    public function setRooms(array $rooms): void
    {
        $this->rooms = $rooms;
    }

    public function addRoom(RoomInterface $room): self
    {
        if (!$this->rooms->contains($room)) {
            $this->rooms[] = $room;
        }

        return $this;
    }

    public function removeRoom(RoomInterface $room): self
    {
        if ($this->rooms->contains($room)) {
            $this->rooms->removeElement($room);
        }

        return $this;
    }

    public function getRole(): ?int
    {
        return $this->role;
    }

    public function setRole(?int $role): void
    {
        $this->role = $role;
    }

    /**
     * @return UserInterface[]
     */
    public function getUsers(): array
    {
        return $this->users;
    }

    /**
     * @param UserInterface[]|array
     * @param UserInterface[] $users
     */
    public function setUsers(array $users): void
    {
        $this->users = $users;
    }
}
