<?php

namespace Grr\Core\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Grr\Core\Contrat\Entity\EntryInterface;
use Grr\Core\Doctrine\Traits\IdEntityTrait;
use Grr\Core\Periodicity\PeriodicityConstant;
use Symfony\Component\Validator\Constraints as Assert;

/**
 *
 */
trait PeriodicityTrait
{
    use IdEntityTrait;
    use EntriesFieldTrait;

    /**
     * @ORM\Column(type="date")
     * @Assert\Type("DateTime")
     * @var \DateTimeInterface
     */
    private $endTime;

    /**
     * Every month, every day, every...
     *
     * @see PeriodicityConstant::getTypesPeriodicite
     *
     * @ORM\Column(type="integer", nullable=false)
     *
     * @var int
     */
    private $type;

    /**
     * @ORM\Column(type="integer", nullable=true)
     *
     * @var int|null
     */
    private $weekRepeat;

    /**
     * Monday, tuesday, wednesday...
     *
     * @see DateProvider::getNamesDaysOfWeek();
     *
     * @var int[]
     * @ORM\Column(type="array", nullable=true)
     */
    private $weekDays;

    /**
     * Override mappedBy
     * @ORM\OneToMany(targetEntity="Grr\Core\Contrat\Entity\EntryInterface", mappedBy="periodicity")
     */
    private $entries;

    /**
     * Use for validator form.
     *
     * @var EntryInterface|null
     */
    private $entryReference;

    public function __construct(?EntryInterface $entry = null)
    {
        $this->type = 0;
        $this->weekDays = [];
        $this->entries = new ArrayCollection();
        $this->entryReference = $entry;
    }

    public function getEntryReference(): ?EntryInterface
    {
        return $this->entryReference;
    }

    public function setEntryReference(?EntryInterface $entry_reference): void
    {
        $this->entryReference = $entry_reference;
    }

    public function getEndTime(): ?\DateTimeInterface
    {
        return $this->endTime;
    }

    public function setEndTime(\DateTimeInterface $endTime): self
    {
        $this->endTime = $endTime;

        return $this;
    }

    public function getType(): ?int
    {
        return $this->type;
    }

    public function setType(int $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getWeekRepeat(): ?int
    {
        return $this->weekRepeat;
    }

    public function setWeekRepeat(?int $weekRepeat): self
    {
        $this->weekRepeat = $weekRepeat;

        return $this;
    }

    public function getWeekDays(): ?array
    {
        return $this->weekDays;
    }

    public function setWeekDays(?array $weekDays): self
    {
        $this->weekDays = $weekDays;

        return $this;
    }

}
