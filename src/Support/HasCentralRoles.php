<?php

namespace Kiani\CentralAuth\Support;

use Kiani\CentralAuth\Models\CentralRole;

trait HasCentralRoles
{
    public function roles()
    {
        return $this->belongsToMany(
            CentralRole::class,
            CentralAuth::table('pivot'),
            CentralAuth::pivotKey('user_fk'),
            CentralAuth::pivotKey('role_fk')
        );
    }

    public function hasRole(string $role): bool
    {
        $col = CentralAuth::roleColumn();

        return $this->roles()->where($col, $role)->exists();
    }

    public function hasAnyRole($roles): bool
    {
        $roles = (array) $roles;
        $col   = CentralAuth::roleColumn();

        return $this->roles()->whereIn($col, $roles)->exists();
    }

    public function authorizeRoles($roles): bool
    {
        $roles = (array) $roles;

        if (!$this->hasAnyRole($roles)) {
            abort(403, 'Forbidden.');
        }

        return true;
    }
}
