<?php

namespace Grr\Core\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Grr\Core\Doctrine\Traits\IdEntityTrait;
use Grr\Core\Doctrine\Traits\NameEntityTrait;
use Grr\GrrBundle\Entity\Room;
use Symfony\Component\Validator\Constraints as Assert;

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
}
