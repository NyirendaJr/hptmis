<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use App\Services\Acl;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class SyncPermissionController extends Controller
{
    public function update()
    {
        try {
            $class = new \ReflectionClass(Acl::class);
            $constants = $class->getConstants();
            $permissions = Arr::where($constants, function ($value, $key) {
                return Str::startsWith($key, 'PERMISSION_');
            });

            $permissionsArray = array_values($permissions);

            foreach ($permissionsArray as $perms) {
                Permission::firstOrcreate([
                    'name' => $perms
                ]);
            }

            $adminRole = Role::findByName(Acl::ROLE_ADMIN);
            $permissions = Permission::all();
            $adminRole->syncPermissions($permissions);

            return response()->json(['message' => 'Permissions synced successfully']);
        } catch (\ReflectionException $exception) {
            return [];
        }
    }
}
