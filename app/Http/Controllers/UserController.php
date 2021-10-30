<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index()
    {
        return Inertia::render('Administration::AllUser');
    }

    public function show(User $user)
    {
        return Inertia::render('Administration::UserProfile', [
            'user' => new UserResource($user)
        ]);
    }
}
