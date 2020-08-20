<?php

namespace Grr\Core\Entry\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Grr\Core\Contrat\Entity\AreaInterface;
use Grr\Core\Contrat\Entity\EntryInterface;
use Grr\Core\Contrat\Entity\TypeEntryInterface;
use Grr\Core\Doctrine\Traits\IdEntityTrait;
use Grr\Core\Doctrine\Traits\NameEntityTrait;
use Grr\Core\Model\DurationModel;
use Grr\Core\Model\TimeSlot;
use Grr\Core\Periodicity\Entity\PeriodicityFieldTrait;
use Grr\Core\Room\Entity\RoomFieldTrait;
use Knp\DoctrineBehaviors\Model\Timestampable\TimestampableTrait;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Entry.
 */
trait EntryTrait
{
    use IdEntityTrait;
    use NameEntityTrait;
    use TimestampableTrait;
    use RoomFieldTrait;
    use PeriodicityFieldTrait;

    /**
     * @var \DateTimeInterface
     *
     * @Assert\Type("DateTime")
     * @Assert\LessThan(propertyPath="endTime", message="entry.constraint.start_smaller_end")
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $startTime;

    /**
     * @var \DateTimeInterface
     * @Assert\Type("DateTime")
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $endTime;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string", length=100, nullable=false)
     */
    private $createdBy;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string", length=100, nullable=false)
     */
    private $reservedFor;

    /**
     * @var string|null
     *
     * @ORM\Column(type="text", length=65535, nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=1, nullable=true)
     */
    private $statutEntry;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", nullable=false)
     */
    private $optionReservation;

    /**
     * @var string|null
     *
     * @ORM\Column(type="text", length=65535, nullable=true)
     */
    private $overloadDesc;

    /**
     * @var bool|null
     *
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $moderate;

    /**
     * @var bool|null
     *
     * @ORM\Column(type="boolean", options={"default": 0})
     */
    private $private;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean", nullable=false)
     */
    private $jours;

    /**
     * @var TypeEntryInterface|null
     * @ORM\ManyToOne(targetEntity="Grr\Core\Contrat\Entity\TypeEntryInterface", inversedBy="entries")
     * @ORM\JoinColumn(onDelete="SET NULL", nullable=true)
     */
    private $type;

    /**
     * Util lors de l'ajout d'un Entry.
     *
     * @var AreaInterface|null
     */
    private $area;

    /**
     * @var DurationModel
     */
    private $duration;

    /**
     * Pour l'affichage, TimeSlot présents.
     *
     * @var ArrayCollection|TimeSlot[]
     */
    private $locations = [];

    /**
     * Pour l'affichage par jour, nbre de cellules occupees.
     *
     * @var int
     */
    private $cellules;

    public function __construct()
    {
        $this->locations = new ArrayCollection();
        $this->private = false;
        $this->moderate = false;
        $this->jours = false;
        $this->optionReservation = 0;
    }

    public function __toString(): string
    {
        return $this->name;
    }

    public function getCellules(): int
    {
        return $this->cellules;
    }

    /**
     * @return EntryInterface
     */
    public function setCellules(int $cellules): void
    {
        $this->cellules = $cellules;
    }

    public function addLocation(array $location): void
    {
        if (!$this->locations->contains($location)) {
            $this->locations[] = $location;
        }
    }

    public function getDuration(): ?DurationModel
    {
        return $this->duration;
    }

    /**
     * @return EntryInterface
     */
    public function setDuration(?DurationModel $duration): void
    {
        $this->duration = $duration;
    }

    public function getArea(): ?AreaInterface
    {
        return $this->area;
    }

    public function setArea(?AreaInterface $area): void
    {
        $this->area = $area;
    }

    /**
     * @return Collection|array|TimeSlot[]
     */
    public function getLocations(): array
    {
        return $this->locations;
    }

    public function setLocations(array $locations): void
    {
        $this->locations = $locations;
    }

    public function getStartTime(): ?\DateTimeInterface
    {
        return $this->startTime;
    }

    public function setStartTime(\DateTimeInterface $startTime): void
    {
        $this->startTime = $startTime;
    }

    public function getEndTime(): ?\DateTimeInterface
    {
        return $this->endTime;
    }

    public function setEndTime(\DateTimeInterface $endTime): void
    {
        $this->endTime = $endTime;
    }

    public function getCreatedBy(): ?string
    {
        return $this->createdBy;
    }

    public function setCreatedBy(string $createdBy): void
    {
        $this->createdBy = $createdBy;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function getStatutEntry(): ?string
    {
        return $this->statutEntry;
    }

    public function setStatutEntry(?string $statutEntry): void
    {
        $this->statutEntry = $statutEntry;
    }

    public function getOptionReservation(): ?int
    {
        return $this->optionReservation;
    }

    public function setOptionReservation(int $optionReservation): void
    {
        $this->optionReservation = $optionReservation;
    }

    public function getOverloadDesc(): ?string
    {
        return $this->overloadDesc;
    }

    public function setOverloadDesc(?string $overloadDesc): void
    {
        $this->overloadDesc = $overloadDesc;
    }

    public function getModerate(): ?bool
    {
        return $this->moderate;
    }

    public function setModerate(?bool $moderate): void
    {
        $this->moderate = $moderate;
    }

    public function getPrivate(): ?bool
    {
        return $this->private;
    }

    public function setPrivate(bool $private): void
    {
        $this->private = $private;
    }

    public function getJours(): ?bool
    {
        return $this->jours;
    }

    public function setJours(bool $jours): void
    {
        $this->jours = $jours;
    }

    public function getType(): ?TypeEntryInterface
    {
        return $this->type;
    }

    public function setType(?TypeEntryInterface $type): void
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getReservedFor(): ?string
    {
        return $this->reservedFor;
    }

    public function setReservedFor(string $reservedFor): void
    {
        $this->reservedFor = $reservedFor;
    }
}
