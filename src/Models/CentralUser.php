<?php

namespace Kiani\CentralAuth\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Kiani\CentralAuth\Contracts\CentralAuthorizable;
use Kiani\CentralAuth\Support\CentralAuth;

class CentralUser extends Authenticatable implements CentralAuthorizable
{
    protected $guarded = [];
    protected $hidden  = ['password', 'remember_token'];

    public function getConnectionName()
    {
        return CentralAuth::connectionName() ?: parent::getConnectionName();
    }

    public function getTable()
    {
        return CentralAuth::table('users');
    }

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

        // cache per-user+role check
        return (bool) CentralAuth::remember("u:{$this->getKey()}:role:{$role}", function () use ($col, $role) {
            return $this->roles()->where($col, $role)->exists();
        });
    }

    public function hasAnyRole($roles): bool
    {
        $roles = (array) $roles;
        $col   = CentralAuth::roleColumn();

        $cacheSuffix = "u:{$this->getKey()}:roles:" . md5(json_encode($roles));

        return (bool) CentralAuth::remember($cacheSuffix, function () use ($col, $roles) {
            return $this->roles()->whereIn($col, $roles)->exists();
        });
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
