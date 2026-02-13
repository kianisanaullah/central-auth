<?php

namespace Kiani\CentralAuth\Contracts;

interface CentralAuthorizable
{
    public function hasRole(string $role): bool;

    /**
     * @param array|string $roles
     */
    public function hasAnyRole($roles): bool;

    /**
     * @param array|string $roles
     */
    public function authorizeRoles($roles): bool;
}
