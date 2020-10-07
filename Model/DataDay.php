<?php


namespace Grr\Core\Model;

use Carbon\CarbonInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Grr\Core\Contrat\Entity\EntryInterface;

class DataDay
{
    /**
     * @var CarbonInterface
     */
    protected $day;

    /**
     * @var ArrayCollection|EntryInterface[]
     */
    protected $entries;

    public function __construct(CarbonInterface $day)
    {
        $this->day = $day;
        $this->entries = new ArrayCollection();
    }

    /**
     * @return CarbonInterface
     */
    public function getDay(): CarbonInterface
    {
        return $this->day;
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

    public function addEntries(array $entries): void
    {
        foreach ($entries as $entry) {
            $this->addEntry($entry);
        }
    }
}
