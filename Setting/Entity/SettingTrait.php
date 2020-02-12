<?php

namespace Grr\Core\Setting\Entity;

use Doctrine\ORM\Mapping as ORM;
use Grr\Core\Doctrine\Traits\IdEntityTrait;

/**
 * Setting.
 */
trait SettingTrait
{
    use IdEntityTrait;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=32, nullable=false, unique=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=false)
     */
    private $value;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean", nullable=false)
     */
    private $required;

    public function __construct(string $name, $value)
    {
        $this->name = $name;
        $this->value = $value;
        $this->required = false;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function setValue(string $value): void
    {
        $this->value = $value;

        return $this;
    }

    public function setName(string $name): void
    {
        $this->name = $name;

        return $this;
    }

    public function getRequired(): bool
    {
        return $this->required;
    }

    public function setRequired(bool $required): void
    {
        $this->required = $required;

        return $this;
    }
}
