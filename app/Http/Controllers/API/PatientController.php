<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePatientFormRequest;
use App\Http\Resources\PatientResource;
use App\Models\Patient\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class PatientController extends Controller
{

    public function index(Request $request)
    {
        $keyword = Arr::get($request, 'keyword', '');

        $patientQuery = Patient::query();

        if (!empty($keyword)) {
            $patientQuery->where('nin', '=', $keyword);
        }

        return PatientResource::collection($patientQuery->get());
    }

    public function store(CreatePatientFormRequest $request)
    {
        // $request['health_facility_id'] = request()->user()->health_facility_id;
        $data = array_merge(
            ['health_facility_id' => request()->user()->health_facility_id],
            $request->validated()
        );
        $patient = Patient::create($data);

        if (!$patient) {
            app()->abort(500, 'Internal Server Error');
        }

        return response()
            ->json([
                'status' => true,
                'statusCode' => 200
            ]);
    }
}
