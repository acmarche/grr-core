<?php

namespace Grr\Core\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Grr\Core\Contrat\Entity\EntryInterface;
use Grr\Core\Contrat\Entity\RoomInterface;

class RoomModel
{
    /**
     * @var ArrayCollection|DataDay[]
     */
    protected $data_days;

    /**
     * @var ArrayCollection|EntryInterface[]
     */
    private array|ArrayCollection $entries;

    public function __construct(
        protected RoomInterface $room
    ) {
        $this->data_days = new ArrayCollection();
        $this->entries = new ArrayCollection();
    }

    public function getRoom(): RoomInterface
    {
        return $this->room;
    }

    public function addDataDay(DataDay $day): void
    {
        if (! $this->data_days->contains($day)) {
            $this->data_days[] = $day;
        }
    }

    /**
     * @return DataDay[]|ArrayCollection
     */
    public function getDataDays(): array|ArrayCollection
    {
        return $this->data_days;
    }

    /**
     * @return EntryInterface[]|ArrayCollection
     */
    public function getEntries(): array|ArrayCollection
    {
        return $this->entries;
    }

    public function setEntries(ArrayCollection|array $entries): void
    {
        $this->entries = $entries;
    }
}
