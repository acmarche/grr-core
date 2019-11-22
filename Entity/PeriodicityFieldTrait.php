<?php
/**
 * This file is part of grr5 application
 * @author jfsenechal <jfsenechal@gmail.com>
 * @date 22/11/19
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 */

namespace Grr\Core\Entity;

trait PeriodicityFieldTrait
{
    /**
     * @Assert\Type("Grr\Core\Entity\PeriodicityInterface")
     * @Assert\Valid
     * @ORM\ManyToOne(targetEntity="Grr\Core\Entity\PeriodicityInterface", inversedBy="entries", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=true, onDelete="SET NULL")
     *
     * @var PeriodicityInterface|null
     */
    private $periodicity;

    public function getPeriodicity(): ?PeriodicityInterface
    {
        return $this->periodicity;
    }

    public function setPeriodicity(?PeriodicityInterface $periodicity): self
    {
        $this->periodicity = $periodicity;

        return $this;
    }
}