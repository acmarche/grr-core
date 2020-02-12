<?php
/**
 * Created by PhpStorm.
 * User: jfsenechal
 * Date: 20/03/19
 * Time: 17:14.
 */

namespace Grr\Core\Model;

use Carbon\CarbonImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Grr\Core\Contrat\Entity\EntryInterface;

class Day extends CarbonImmutable
{
    /**
     * @var ArrayCollection|EntryInterface[]
     */
    protected $entries;

    public function __construct($time = null, $tz = null)
    {
        parent::__construct($time, $tz);
        $this->entries = new ArrayCollection();
    }

    /**
     * @return Collection|EntryInterface[]
     */
    public function getEntries(): Collection
    {
        return $this->entries;
    }

    /**
     * @param EntryInterface[]|ArrayCollection $entries
     *
     * @return Day
     */
    public function setEntries($entries): void
    {
        $this->entries = $entries;
    }

    public function addEntry(EntryInterface $entry): void
    {
        if (!$this->entries->contains($entry)) {
            $this->entries[] = $entry;
        }
    }

    public function addEntries(array $entries)
    {
        foreach ($entries as $entry) {
            $this->addEntry($entry);
        }
    }
}
