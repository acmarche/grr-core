<?php
/**
 * This file is part of grr5 application.
 *
 * @author jfsenechal <jfsenechal@gmail.com>
 * @date 22/11/19
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Grr\Core\TypeEntry\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Grr\Core\Contrat\Entity\TypeEntryInterface;

trait TypesEntryFieldTrait
{
    /**
     * @var TypeEntryInterface[]|Collection
     */
    #[ORM\ManyToMany(targetEntity: TypeEntryInterface::class)]
    #[ORM\JoinTable(name: 'area_entry_type')]
    private iterable $typesEntry;

    /**
     * @return Collection|TypeEntryInterface[]
     */
    public function getTypesEntry(): Collection
    {
        return $this->typesEntry;
    }

    public function addTypeEntry(TypeEntryInterface $typeEntry): void
    {
        if (! $this->typesEntry->contains($typeEntry)) {
            $this->typesEntry[] = $typeEntry;
        }
    }

    public function removeTypeEntry(TypeEntryInterface $typeEntry): void
    {
        if ($this->typesEntry->contains($typeEntry)) {
            $this->typesEntry->removeElement($typeEntry);
        }
    }
}
