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


trait RoomFieldTrait
{
    /**
     * @var RoomInterface
     * @ORM\ManyToOne(targetEntity="Grr\Core\Entity\RoomInterface", inversedBy="entries")
     * @ORM\JoinColumn(nullable=false)
     */
    private $room;

    public function getRoom(): ?RoomInterface
    {
        return $this->room;
    }

    public function setRoom(?RoomInterface $room): self
    {
        $this->room = $room;

        return $this;
    }
}