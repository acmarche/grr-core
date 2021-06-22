<?php

namespace Grr\Core\Security;

use stdClass;

class SecurityRole
{
    /**
     * Role minimal pour être authentifié.
     * Simple visiteur.
     */
    public const ROLE_GRR = 'ROLE_GRR';
    /**
     * Role utilisateur actif.
     */
    public const ROLE_GRR_ACTIVE_USER = 'ROLE_GRR_ACTIVE_USER';
    /**
     * Gestionnaire des utilisateurs.
     */
    public const ROLE_GRR_MANAGER_USER = 'ROLE_GRR_MANAGER_USER';
    /**
     * Administrateur de grr.
     */
    public const ROLE_GRR_ADMINISTRATOR = 'ROLE_GRR_ADMINISTRATOR';
    /**
     * Developpeur de grr.
     */
    public const ROLE_GRR_DEVELOPER = 'ROLE_GRR_DEVELOPER';
    /**
     * @return mixed[]|bool
     */
    public const ROLES = [
        //self::ROLE_GRR => 'Visiteur',
        self::ROLE_GRR_ACTIVE_USER => 'Utilisateur actif',
        self::ROLE_GRR_MANAGER_USER => 'Gestionnaire des utilisateurs',
        self::ROLE_GRR_ADMINISTRATOR => 'Administrateur de Grr',
        self::ROLE_GRR_DEVELOPER => 'Developpeur de Grr',
    ];

    public static function niceName(array $roles): array
    {
        $nices = [];
        foreach ($roles as $role) {
            if (isset(self::ROLES[$role])) {
                $nice = self::ROLES[$role];
                $nices[] = $nice;
            }
        }

        return $nices;
    }

    /**
     * Utilisé pour le formulaire d'authorization.
     *
     * @return stdClass[]
     */
    public static function getRolesForAuthorization(): array
    {
        $areaAdministrator = new stdClass();
        $areaAdministrator->value = 1;
        $areaAdministrator->name = 'authorization.role.area.administrator.label';
        $areaAdministrator->description = 'authorization.role.area.administrator.help';

        $resourceAdministrator = new stdClass();
        $resourceAdministrator->value = 2;
        $resourceAdministrator->name = 'authorization.role.resource.administrator.label';
        $resourceAdministrator->description = 'authorization.role.resource.administrator.help';

        return [$areaAdministrator, $resourceAdministrator];
    }
}
