<?php
/**
 * This file is part of sf5 application
 * @author jfsenechal <jfsenechal@gmail.com>
 * @date 21/11/19
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 */

namespace Grr\Core\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

trait RoomsFieldTrait
{
    /**
     * @ORM\OneToMany(targetEntity="Grr\Core\Entity\RoomInterface", mappedBy="area")
     * @var ArrayCollection
     */
    private $rooms;

    /**
     * @return Collection|RoomInterface[]
     */
    public function getRooms(): Collection
    {
        return $this->rooms;
    }

    public function addRoom(RoomInterface $room): self
    {
        if (!$this->rooms->contains($room)) {
            $this->rooms[] = $room;
            $room->setArea($this);
        }

        return $this;
    }

    public function removeRoom(RoomInterface $room): self
    {
        if ($this->rooms->contains($room)) {
            $this->rooms->removeElement($room);
            // set the owning side to null (unless already changed)
            if ($room->getArea() === $this) {
                $room->setArea(null);
            }
        }

        return $this;
    }
}