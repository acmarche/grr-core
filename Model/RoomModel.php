<?php

namespace Grr\Core\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Grr\Core\Contrat\Entity\EntryInterface;
use Grr\Core\Contrat\Entity\RoomInterface;

class RoomModel
{
    /**
     * @var RoomInterface
     */
    protected $room;

    /**
     * @var ArrayCollection|Day[]
     */
    protected $data_days;
    /**
     * @var ArrayCollection|EntryInterface[]
     */
    private $entries;

    public function __construct(RoomInterface $room)
    {
        $this->room = $room;
        $this->data_days = new ArrayCollection();
        $this->entries = new ArrayCollection();
    }

    public function getRoom(): RoomInterface
    {
        return $this->room;
    }

    public function addDataDay(Day $day): void
    {
        if (!$this->data_days->contains($day)) {
            $this->data_days[] = $day;
        }
    }

    /**
     * @return Day[]|ArrayCollection
     */
    public function getDataDays()
    {
        return $this->data_days;
    }

    /**
     * @return Day[]|ArrayCollection
     */
    public function getEntries()
    {
        return $this->entries;
    }

    public function setEntries($entries): void
    {
        $this->entries = $entries;
    }
}
