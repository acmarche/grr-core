<?php

namespace Grr\Core\Doctrine\Traits;

use Grr\Core\Security\SecurityRole;

trait RolesTrait
{
    private array $roles = [];

    public function getRoles(): ?array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_GRR
        $roles[] = 'ROLE_GRR';

        return array_unique($roles);
    }

    public function addRole(string $role): void
    {
        if (!in_array($role, $this->roles, true)) {
            $this->roles[] = $role;
        }
    }

    public function removeRole(string $role): void
    {
        if (in_array($role, $this->roles, true)) {
            $index = array_search($role, $this->roles);
            unset($this->roles[$index]);
        }
    }

    public function hasRole(string $role): bool
    {
        return in_array($role, $this->getRoles(), true);
    }

    public function setRoles(array $roles): void
    {
        $this->roles = $roles;
    }

    public function getNiceRoles(): array
    {
        return SecurityRole::niceName($this->getRoles());
    }
}
