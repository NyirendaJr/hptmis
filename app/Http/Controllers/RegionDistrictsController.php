<?php

namespace App\Http\Controllers;

use App\Http\Resources\DistrictResource;
use App\Models\Region\Region;
use Illuminate\Http\Request;


class RegionDistrictsController extends Controller
{
    public function index(Request $request)
    {
        $region = Region::find($request->regionId);
        return DistrictResource::collection($region->districts);
    }
}
