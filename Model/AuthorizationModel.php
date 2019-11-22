<?php

namespace Grr\Core\Model;

use Grr\Core\Entity\Area;
use Grr\Core\Entity\Room;
use Grr\Core\Entity\Security\User;
use Doctrine\Common\Collections\ArrayCollection;

class AuthorizationModel
{
    /**
     * @var Area|null
     */
    protected $area;

    /**
     * @var Room[]|array|ArrayCollection
     */
    protected $rooms;

    /**
     * @var User[]|array
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

    public function getArea(): ?Area
    {
        return $this->area;
    }

    public function setArea(?Area $area): void
    {
        $this->area = $area;
    }

    /**
     * @return Grr\Core\Entity\Room[]
     */
    public function getRooms(): ArrayCollection
    {
        return $this->rooms;
    }

    /**
     * @param Room[]|array $rooms
     */
    public function setRooms(array $rooms): void
    {
        $this->rooms = $rooms;
    }

    public function addRoom(Room $room): self
    {
        if (!$this->rooms->contains($room)) {
            $this->rooms[] = $room;
        }

        return $this;
    }

    public function removeRoom(Room $room): self
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
     * @return Grr\Core\Entity\Security\User[]
     */
    public function getUsers(): array
    {
        return $this->users;
    }

    /**
     * @param User[]|array
     * @param Grr\Core\Entity\Security\User[] $users
     */
    public function setUsers(array $users): void
    {
        $this->users = $users;
    }
}
