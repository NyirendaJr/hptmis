<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Services\Acl;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Actions\CreateNewUser;

class UsersTableSeeder extends Seeder
{

    protected $createStore;
    protected $createCompany;
    protected $createUser;
    protected $switchStore;

    public function __construct()
    {
        $this->createUser = new CreateNewUser();
    }

    public function run()
    {
        // sync permissions
        try {
            $class = new \ReflectionClass(Acl::class);
            $constants = $class->getConstants();
            $permissions = Arr::where($constants, function ($value, $key) {
                return Str::startsWith($key, 'PERMISSION_');
            });

            $permissionsArray = array_values($permissions);

            foreach ($permissionsArray as $perms) {
                Permission::firstOrcreate(['name' => $perms]);
            }
        } catch (\ReflectionException $exception) {
            return [];
        }

        // sync all roles
        try {
            $class = new \ReflectionClass(Acl::class);
            $constants = $class->getConstants();
            $roles = Arr::where($constants, function ($value, $key) {
                return Str::startsWith($key, 'ROLE_');
            });

            $rolesArray = array_values($roles);

            foreach ($rolesArray as $role) {
                Role::firstOrcreate(['name' => $role]);
            }
        } catch (\ReflectionException $exception) {
            return [];
        }

        //attach all permissions to the admin roles
        $adminRole = Role::findByName(Acl::ROLE_ADMIN);
        $permissions = Permission::all();
        $adminRole->syncPermissions($permissions);

        $adminPass = $this->command->secret('Enter Admin Password: ');

        // create superuser
        $superuserPayload = [
            'name' => 'Admin',
            'email' => 'thelabdevtz@gmail.com',
            'password' => Hash::make($adminPass),
            //'company_id' => $company->id
        ];

        $superuser = $this->createUser->create($superuserPayload);

        // assign admin role to the superuser
        $superuser->syncRoles($adminRole);
    }
}
