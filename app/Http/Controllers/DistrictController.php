<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\District\District;
use App\Http\Resources\DistrictResource;

class DistrictController extends Controller
{
    public function index()
    {
        return DistrictResource::collection(District::all());
    }
}
