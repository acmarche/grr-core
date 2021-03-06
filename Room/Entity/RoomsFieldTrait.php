<?php
/**
 * This file is part of sf5 application.
 *
 * @author jfsenechal <jfsenechal@gmail.com>
 * @date 21/11/19
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Grr\Core\Room\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Grr\Core\Contrat\Entity\RoomInterface;

trait RoomsFieldTrait
{
    /**
     * @var ArrayCollection
     */
    #[ORM\OneToMany(targetEntity: RoomInterface::class, mappedBy: 'area')]
    private iterable $rooms;

    /**
     * @return Collection|RoomInterface[]
     */
    public function getRooms(): Collection
    {
        return $this->rooms;
    }

    public function addRoom(RoomInterface $room): void
    {
        if (! $this->rooms->contains($room)) {
            $this->rooms[] = $room;
            $room->setArea($this);
        }
    }

    public function removeRoom(RoomInterface $room): void
    {
        if ($this->rooms->contains($room)) {
            $this->rooms->removeElement($room);
            // set the owning side to null (unless already changed)
            if ($room->getArea() === $this) {
                $room->setArea(null);
            }
        }
    }
}
