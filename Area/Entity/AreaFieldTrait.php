<?php
/**
 * This file is part of sf5 application.
 *
 * @author jfsenechal <jfsenechal@gmail.com>
 * @date 21/11/19
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Grr\Core\Area\Entity;

use Doctrine\ORM\Mapping as ORM;
use Grr\Core\Contrat\Entity\AreaInterface;

trait AreaFieldTrait
{
    #[ORM\ManyToOne(targetEntity: AreaInterface::class, inversedBy: 'rooms')]
    #[ORM\JoinColumn(nullable: false)]
    private ?AreaInterface $area = null;

    public function getArea(): ?AreaInterface
    {
        return $this->area;
    }

    public function setArea(?AreaInterface $area): void
    {
        $this->area = $area;
    }
}
