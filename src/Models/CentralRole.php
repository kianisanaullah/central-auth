<?php

namespace Kiani\CentralAuth\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kiani\CentralAuth\Support\CentralAuth;

class CentralRole extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function getConnectionName()
    {
        return CentralAuth::connectionName() ?: parent::getConnectionName();
    }

    public function getTable()
    {
        return CentralAuth::table('roles');
    }
}
