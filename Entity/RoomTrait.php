<?php

namespace Grr\Core\Entity;

use Doctrine\ORM\Mapping as ORM;
use Grr\Core\Doctrine\Traits\IdEntityTrait;
use Grr\Core\Doctrine\Traits\NameEntityTrait;

/**
 * Room.
 *
 * ORM\Table(name="room")
 * ORM\Entity()
 * ApiResource
 */
trait RoomTrait
{
    use IdEntityTrait;
    use NameEntityTrait;
    use AreaFieldTrait;
}
