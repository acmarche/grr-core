<?php
/**
 * This file is part of grr5 application.
 *
 * @author jfsenechal <jfsenechal@gmail.com>
 * @date 22/11/19
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Grr\Core\Entry\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Grr\Core\Contrat\Entity\EntryInterface;

trait EntriesFieldTrait
{
    /**
     * @ORM\OneToMany(targetEntity="Grr\Core\Contrat\Entity\EntryInterface", mappedBy="room", cascade={"remove"})
     *
     * @var EntryInterface[]|Collection
     */
    private iterable $entries;

    /**
     * @return Collection|EntryInterface[]
     */
    public function getEntries(): Collection
    {
        return $this->entries;
    }

    public function addEntry(EntryInterface $entry): void
    {
        if (!$this->entries->contains($entry)) {
            $this->entries[] = $entry;
            $entry->setRoom($this);
        }
    }

    public function removeEntry(EntryInterface $entry): void
    {
        if ($this->entries->contains($entry)) {
            $this->entries->removeElement($entry);
            // set the owning side to null (unless already changed)
            if ($entry->getRoom() === $this) {
                $entry->setRoom(null);
            }
        }
    }
}
