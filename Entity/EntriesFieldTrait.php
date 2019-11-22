<?php
/**
 * This file is part of grr5 application
 * @author jfsenechal <jfsenechal@gmail.com>
 * @date 22/11/19
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 */

namespace Grr\Core\Entity;


use Doctrine\Common\Collections\Collection;

trait EntriesFieldTrait
{
    /**
     * @ORM\OneToMany(targetEntity="Grr\Core\Entity\EntryInterface", mappedBy="room", cascade={"remove"})
     *
     * @var Grr\Core\Entity\EntryInterface[]|\Doctrine\Common\Collections\Collection
     */
    private $entries;

    /**
     * @return Collection|EntryInterface[]
     */
    public function getEntries(): Collection
    {
        return $this->entries;
    }

    public function addEntry(EntryInterface $entry): self
    {
        if (!$this->entries->contains($entry)) {
            $this->entries[] = $entry;
            $entry->setRoom($this);
        }

        return $this;
    }

    public function removeEntry(EntryInterface $entry): self
    {
        if ($this->entries->contains($entry)) {
            $this->entries->removeElement($entry);
            // set the owning side to null (unless already changed)
            if ($entry->getRoom() === $this) {
                $entry->setRoom(null);
            }
        }

        return $this;
    }
}