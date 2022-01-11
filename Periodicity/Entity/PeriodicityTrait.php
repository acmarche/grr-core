<?php

namespace Grr\Core\Periodicity\Entity;

use DateTime;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Grr\Core\Contrat\Entity\EntryInterface;
use Grr\Core\Doctrine\Traits\IdEntityTrait;
use Grr\Core\Entry\Entity\EntriesFieldTrait;
use Grr\Core\Periodicity\PeriodicityConstant;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\Type;

trait PeriodicityTrait
{
    use IdEntityTrait;
    use EntriesFieldTrait;

    #[ORM\Column(type: 'date')]
    #[Assert\Type(type: DateTime::class)]
    private DateTimeInterface $endTime;

    /**
     * Every month, every day, every...
     *
     * @see PeriodicityConstant::getTypesPeriodicite
     */
    #[ORM\Column(type: 'integer', nullable: false)]
    private ?int $type = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $weekRepeat = null;

    /**
     * Monday, tuesday, wednesday...
     *
     * @see DateProvider::weekDaysName();
     *
     * @var int[]
     */
    #[ORM\Column(type: 'array', nullable: true)]
    private array $weekDays;

    /**
     * Override mappedBy.
     *
     * @var EntryInterface[]|Collection
     */
    #[ORM\OneToMany(targetEntity: EntryInterface::class, mappedBy: 'periodicity')]
    private iterable $entries;

    /**
     * Use for validator form.
     */
    private ?EntryInterface $entryReference = null;

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

    public function setEntryReference(?EntryInterface $entry): void
    {
        $this->entryReference = $entry;
    }

    public function getEndTime(): ?DateTimeInterface
    {
        return $this->endTime;
    }

    public function setEndTime(DateTimeInterface $dateTime): void
    {
        $this->endTime = $dateTime;
    }

    public function getType(): ?int
    {
        return $this->type;
    }

    public function setType(?int $type): void
    {
        $this->type = $type;
    }

    public function getWeekRepeat(): ?int
    {
        return $this->weekRepeat;
    }

    public function setWeekRepeat(?int $weekRepeat): void
    {
        $this->weekRepeat = $weekRepeat;
    }

    public function getWeekDays(): ?array
    {
        return $this->weekDays;
    }

    public function setWeekDays(?array $weekDays): void
    {
        $this->weekDays = $weekDays;
    }
}
