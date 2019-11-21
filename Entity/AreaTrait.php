<?php

namespace Grr\Core\Entity;

use Grr\Core\Doctrine\Traits\IdEntityTrait;
use Grr\Core\Doctrine\Traits\NameEntityTrait;

/**
 *
 * ORM\Table(name="area")
 * ORM\Entity()
 *
 */
trait AreaTrait
{
    use IdEntityTrait;
    use NameEntityTrait;
    use RoomFieldTrait;
}
