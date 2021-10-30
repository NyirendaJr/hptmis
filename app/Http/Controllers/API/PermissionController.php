<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\PermissionResource;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class PermissionController extends Controller
{
    const ITEMS_PER_PAGE = 10;

    public function index(Request $request)
    {
        $searchParams = $request->all();
        $keyword = Arr::get($searchParams, 'keyword', '');
        $limit = Arr::get($searchParams, 'limit', static::ITEMS_PER_PAGE);

        $permissionQuery = Permission::query();

        if (!empty($keyword)) {
            $permissionQuery->where('name', 'LIKE', '%' . $keyword . '%');
        }

        return PermissionResource::collection($permissionQuery->paginate($limit));
    }
}
