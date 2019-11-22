<?php
/**
 * This file is part of grr5 application
 * @author jfsenechal <jfsenechal@gmail.com>
 * @date 22/11/19
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 */

namespace Grr\Core\Entity\Security;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

trait AuthorizationsFieldTrait
{
    /**
     * @ORM\OneToMany(targetEntity="Grr\Core\Entity\Security\Authorization", mappedBy="area", orphanRemoval=true)
     *
     * @var Grr\Core\Entity\Security\AuthorizationInterface[]|\Doctrine\Common\Collections\Collection
     */
    private $authorizations;

    /**
     * @return Collection|AuthorizationInterface[]
     */
    public function getAuthorizations(): Collection
    {
        return $this->authorizations;
    }

    public function addAuthorization(AuthorizationInterface $authorization): self
    {
        if (!$this->authorizations->contains($authorization)) {
            $this->authorizations[] = $authorization;
            $authorization->setArea($this);
        }

        return $this;
    }

    public function removeAuthorization(AuthorizationInterface $authorization): self
    {
        if ($this->authorizations->contains($authorization)) {
            $this->authorizations->removeElement($authorization);
            // set the owning side to null (unless already changed)
            if ($authorization->getArea() === $this) {
                $authorization->setArea(null);
            }
        }

        return $this;
    }

}