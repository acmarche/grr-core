<?php
/**
 * This file is part of grr5 application.
 *
 * @author jfsenechal <jfsenechal@gmail.com>
 * @date 22/11/19
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Grr\Core\Authorization\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Grr\Core\Contrat\Entity\Security\AuthorizationInterface;

trait AuthorizationsFieldTrait
{
    /**
     * @var AuthorizationInterface[]|Collection
     */
    #[ORM\OneToMany(targetEntity: AuthorizationInterface::class, mappedBy: 'area', orphanRemoval: true)]
    private iterable $authorizations;

    /**
     * @return Collection|AuthorizationInterface[]
     */
    public function getAuthorizations(): iterable
    {
        return $this->authorizations;
    }

    public function addAuthorization(AuthorizationInterface $authorization): void
    {
        if (! $this->authorizations->contains($authorization)) {
            $this->authorizations[] = $authorization;
            $authorization->setArea($this);
        }
    }

    public function removeAuthorization(AuthorizationInterface $authorization): void
    {
        if ($this->authorizations->contains($authorization)) {
            $this->authorizations->removeElement($authorization);
            // set the owning side to null (unless already changed)
            if ($authorization->getArea() === $this) {
                $authorization->setArea(null);
            }
        }
    }
}
