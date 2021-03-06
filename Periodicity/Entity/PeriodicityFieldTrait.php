<?php
/**
 * This file is part of grr5 application.
 *
 * @author jfsenechal <jfsenechal@gmail.com>
 * @date 22/11/19
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Grr\Core\Periodicity\Entity;

use Doctrine\ORM\Mapping as ORM;
use Grr\Core\Contrat\Entity\PeriodicityInterface;
use Symfony\Component\Validator\Constraints as Assert;

trait PeriodicityFieldTrait
{
    /**
     * @var PeriodicityInterface|null
     */
    #[Assert\Type(type: PeriodicityInterface::class)]
    #[Assert\Valid]
    #[ORM\ManyToOne(targetEntity: PeriodicityInterface::class, inversedBy: 'entries', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: true, onDelete: 'SET NULL')]
    private ?PeriodicityInterface $periodicity = null;

    public function getPeriodicity(): ?PeriodicityInterface
    {
        return $this->periodicity;
    }

    public function setPeriodicity(?PeriodicityInterface $periodicity): void
    {
        $this->periodicity = $periodicity;
    }
}
