<?php

namespace App\Models;

use App\Services\Acl;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Permission extends \Spatie\Permission\Models\Permission
{
    use HasFactory;

    protected $fillable = [];
    protected $guard_name = 'sanctum';

    public function scopeAllowed($query)
    {
        return $query
            ->where('name', '!=', Acl::PERMISSION_SYNC_PERMISSIONS)
            ->where('name', '!=', Acl::PERMISSION_UPDATE_ROLE_PERMISSIONS)
            ->where('name', '!=', Acl::PERMISSION_VIEW_MENU_PERMISSION)
            ->where('name', '!=', Acl::PERMISSION_VIEW_MENU_PERMISSION)
            ->where('name', '!=', Acl::PERMISSION_VIEW_MENU_ROLES);
    }
}
