<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\PermissionResource;
use App\Http\Resources\RoleResource;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class RolePermissionController extends Controller
{
    public function index(Role $role)
    {
        return PermissionResource::collection($role->permissions);
    }

    public function update(Request $request, Role $role)
    {
        if ($role === null || $role->isAdmin()) {
            throw new \Exception('Role Not found');
            // return response()->json(['error' => 'Role not found'], 404);
        }

        $permissionIds = $request->get('permissions', []);
        $permissions = Permission::allowed()->whereIn('id', $permissionIds)->get();
        $role->syncPermissions($permissions);
        $role->save();
        return new RoleResource($role);
    }
}
