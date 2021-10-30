<?php

namespace App\Models;

use App\Services\Acl;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends \Spatie\Permission\Models\Role
{
    use HasFactory;

    public $guard_name = 'sanctum';
    protected $fillable = [];

    /**
     * Check whether current role is admin
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->name === Acl::ROLE_ADMIN;
    }
}
