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

use Grr\Core\Entity\EntryTypeInterface;
use Doctrine\Common\Collections\Collection;

trait EntryTypesFieldTrait
{
    /**
     * @ORM\ManyToMany(targetEntity="Grr\Core\Entity\EntryTypeInterface")
     *
     * @var EntryTypeInterface[]|\Doctrine\Common\Collections\Collection
     */
    private $entryTypes;

    /**
     * @return Collection|EntryTypeInterface[]
     */
    public function getEntryTypes(): Collection
    {
        return $this->entryTypes;
    }

    public function addEntryType(EntryTypeInterface $entryType): self
    {
        if (!$this->entryTypes->contains($entryType)) {
            $this->entryTypes[] = $entryType;
        }

        return $this;
    }

    public function removeEntryType(EntryTypeInterface $entryType): self
    {
        if ($this->entryTypes->contains($entryType)) {
            $this->entryTypes->removeElement($entryType);
        }

        return $this;
    }
}