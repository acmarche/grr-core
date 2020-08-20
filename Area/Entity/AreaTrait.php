<?php

namespace Grr\Core\Area\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Grr\Core\Authorization\Entity\AuthorizationsFieldTrait;
use Grr\Core\Doctrine\Traits\IdEntityTrait;
use Grr\Core\Doctrine\Traits\NameEntityTrait;
use Grr\Core\Room\Entity\RoomsFieldTrait;
use Grr\Core\TypeEntry\Entity\TypesEntryFieldTrait;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Area.
 */
trait AreaTrait
{
    use IdEntityTrait;
    use NameEntityTrait;
    use RoomsFieldTrait;
    use AuthorizationsFieldTrait;
    use TypesEntryFieldTrait;

    /**
     * @var int
     *
     * @ORM\Column(type="smallint", nullable=false)
     */
    private $orderDisplay;

    /**
     * @var int
     * @Assert\LessThan(propertyPath="endTime", message="area.constraint.start_smaller_end")
     * @ORM\Column(type="smallint", nullable=false)
     */
    private $startTime;

    /**
     * @var int
     *
     * @ORM\Column(type="smallint", nullable=false)
     */
    private $endTime;

    /**
     * @var int
     *
     * @ORM\Column(type="smallint", nullable=false)
     */
    private $weekStart;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean", nullable=false)
     */
    private $is24HourFormat;
    /**
     * @var array
     *
     * @ORM\Column(type="array", nullable=false)
     */
    private $daysOfWeekToDisplay;

    /**
     * Intervalle de temps.
     *
     * @var int
     *
     * @ORM\Column(type="integer", nullable=false)
     */
    private $timeInterval;

    /**
     * Durée maximum qu'un utilisateur peut réserver.
     *
     * @var int
     *
     * @ORM\Column(type="integer", nullable=false)
     */
    private $durationMaximumEntry;

    /**
     * Durée par défaut d'une réservation.
     *
     * @var int
     *
     * @ORM\Column(type="integer", nullable=false)
     */
    private $durationDefaultEntry;

    /**
     * @var int
     *
     * @ORM\Column(type="smallint", nullable=false)
     */
    private $minutesToAddToEndTime;

    /**
     * @var int
     *
     * @ORM\Column(type="smallint", nullable=false)
     */
    private $maxBooking;

    /**
     * @var bool
     * @ORM\Column(type="boolean")
     */
    private $isRestricted;

    public function __construct()
    {
        $this->startTime = 8;
        $this->endTime = 19;
        $this->is24HourFormat = true;
        $this->orderDisplay = 0;
        $this->weekStart = 0;
        $this->daysOfWeekToDisplay = [1, 2, 3, 4, 5];
        $this->timeInterval = 30;
        $this->durationDefaultEntry = 30;
        $this->durationMaximumEntry = -1;
        $this->minutesToAddToEndTime = 0;
        $this->maxBooking = -1;
        $this->isRestricted = false;
        $this->rooms = new ArrayCollection();
        $this->authorizations = new ArrayCollection();
        $this->typesEntry = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->name;
    }

    public function getOrderDisplay(): ?int
    {
        return $this->orderDisplay;
    }

    public function setOrderDisplay(int $orderDisplay): void
    {
        $this->orderDisplay = $orderDisplay;
    }

    public function getStartTime(): ?int
    {
        return $this->startTime;
    }

    public function setStartTime(int $startTime): void
    {
        $this->startTime = $startTime;
    }

    public function getEndTime(): ?int
    {
        return $this->endTime;
    }

    public function setEndTime(int $endTime): void
    {
        $this->endTime = $endTime;
    }

    public function getWeekStart(): ?int
    {
        return $this->weekStart;
    }

    public function setWeekStart(int $weekStart): void
    {
        $this->weekStart = $weekStart;
    }

    public function getIs24HourFormat(): ?bool
    {
        return $this->is24HourFormat;
    }

    public function setIs24HourFormat(bool $is24HourFormat): void
    {
        $this->is24HourFormat = $is24HourFormat;
    }

    public function getDaysOfWeekToDisplay(): ?array
    {
        return $this->daysOfWeekToDisplay;
    }

    public function setDaysOfWeekToDisplay(array $daysOfWeekToDisplay): void
    {
        $this->daysOfWeekToDisplay = $daysOfWeekToDisplay;
    }

    public function getTimeInterval(): ?int
    {
        return $this->timeInterval;
    }

    public function setTimeInterval(int $timeInterval): void
    {
        $this->timeInterval = $timeInterval;
    }

    public function getDurationMaximumEntry(): ?int
    {
        return $this->durationMaximumEntry;
    }

    public function setDurationMaximumEntry(int $durationMaximumEntry): void
    {
        $this->durationMaximumEntry = $durationMaximumEntry;
    }

    public function getDurationDefaultEntry(): ?int
    {
        return $this->durationDefaultEntry;
    }

    public function setDurationDefaultEntry(int $durationDefaultEntry): void
    {
        $this->durationDefaultEntry = $durationDefaultEntry;
    }

    public function getMinutesToAddToEndTime(): ?int
    {
        return $this->minutesToAddToEndTime;
    }

    public function setMinutesToAddToEndTime(int $minutesToAddToEndTime): void
    {
        $this->minutesToAddToEndTime = $minutesToAddToEndTime;
    }

    public function getMaxBooking(): ?int
    {
        return $this->maxBooking;
    }

    public function setMaxBooking(int $maxBooking): void
    {
        $this->maxBooking = $maxBooking;
    }

    public function getIsRestricted(): ?bool
    {
        return $this->isRestricted;
    }

    public function setIsRestricted(bool $isRestricted): void
    {
        $this->isRestricted = $isRestricted;
    }
}
