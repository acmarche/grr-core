<?php
/**
 * This file is part of grr5 application.
 *
 * @author jfsenechal <jfsenechal@gmail.com>
 * @date 22/11/19
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Grr\Core\Room\Entity;

use Doctrine\ORM\Mapping as ORM;
use Grr\Core\Contrat\Entity\RoomInterface;

trait RoomFieldTrait
{
    /**
     * @var RoomInterface
     */
    #[ORM\ManyToOne(targetEntity: RoomInterface::class, inversedBy: 'entries')]
    #[ORM\JoinColumn(nullable: false)]
    private ?RoomInterface $room = null;

    public function getRoom(): ?RoomInterface
    {
        return $this->room;
    }

    public function setRoom(?RoomInterface $room): void
    {
        $this->room = $room;
    }
}
