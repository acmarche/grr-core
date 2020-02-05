<?php

namespace Grr\Core\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Grr\Core\Doctrine\Traits\IdEntityTrait;
use Grr\Core\Doctrine\Traits\NameEntityTrait;
use Symfony\Component\Validator\Constraints as Assert;

/**
 */
trait EntryTypeTrait
{
    use IdEntityTrait;
    use NameEntityTrait;
    use EntriesFieldTrait;

    /**
     * @var int
     *
     * @ORM\Column(type="smallint", nullable=false)
     */
    private $orderDisplay;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $color;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=2, nullable=false, unique=true)
     */
    private $letter;

    /**
     * @var int
     *
     * @ORM\Column(type="smallint", nullable=false)
     */
    private $available;

    /**
     * Override mappedBy
     * @ORM\OneToMany(targetEntity="Grr\Core\Contrat\Entity\EntryInterface", mappedBy="type")
     */
    private $entries;

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

    public function getOrderDisplay(): ?int
    {
        return $this->orderDisplay;
    }

    public function setOrderDisplay(int $orderDisplay): self
    {
        $this->orderDisplay = $orderDisplay;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(?string $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function getLetter(): ?string
    {
        return $this->letter;
    }

    public function setLetter(string $letter): self
    {
        $this->letter = $letter;

        return $this;
    }

    /**
     * @return int
     */
    public function getAvailable(): int
    {
        return $this->available;
    }

    /**
     * @param int $available
     */
    public function setAvailable(int $available): void
    {
        $this->available = $available;
    }

}
