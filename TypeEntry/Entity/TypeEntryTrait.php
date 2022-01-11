<?php

namespace Grr\Core\TypeEntry\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Grr\Core\Contrat\Entity\EntryInterface;
use Grr\Core\Doctrine\Traits\IdEntityTrait;
use Grr\Core\Doctrine\Traits\NameEntityTrait;
use Grr\Core\Entry\Entity\EntriesFieldTrait;

trait TypeEntryTrait
{
    use IdEntityTrait;
    use NameEntityTrait;
    use EntriesFieldTrait;

    /**
     * @var int
     */
    #[ORM\Column(type: 'smallint', nullable: false)]
    private int $orderDisplay;

    /**
     * @var string|null
     */
    #[ORM\Column(type: 'string', nullable: true)]
    private ?string $color = null;

    /**
     * @var string
     */
    #[ORM\Column(type: 'string', length: 2, nullable: false, unique: true)]
    private string $letter;

    /**
     * @var int
     */
    #[ORM\Column(type: 'smallint', nullable: false)]
    private int $available;

    /**
     * Override mappedBy.
     *
     * @var EntryInterface[]|Collection
     */
    #[ORM\OneToMany(targetEntity: EntryInterface::class, mappedBy: 'type')]
    private iterable $entries;

    public function __construct()
    {
        $this->entries = new ArrayCollection();
        $this->orderDisplay = 0;
        $this->available = 2;
    }

    public function __toString(): string
    {
        return $this->name;
    }

    public function getOrderDisplay(): int
    {
        return $this->orderDisplay;
    }

    public function setOrderDisplay(int $orderDisplay): void
    {
        $this->orderDisplay = $orderDisplay;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(?string $color): void
    {
        $this->color = $color;
    }

    public function getLetter(): ?string
    {
        return $this->letter;
    }

    public function setLetter(string $letter): void
    {
        $this->letter = $letter;
    }

    public function getAvailable(): int
    {
        return $this->available;
    }

    public function setAvailable(int $available): void
    {
        $this->available = $available;
    }
}
