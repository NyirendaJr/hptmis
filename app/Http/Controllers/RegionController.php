<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Region\Region;
use App\Http\Resources\RegionResource;

class RegionController extends Controller
{
    public function index()
    {
        return RegionResource::collection(Region::all());
    }
}
