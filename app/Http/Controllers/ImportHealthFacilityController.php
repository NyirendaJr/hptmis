<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\HealthFacilityImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ImportHealthFacilityController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request)
    {
        $health_facilities = Excel::toArray('', $this->getFilePath(), 'local');

        foreach ($health_facilities[0] as $row) {
            $arr[] = [
                'facility_number' => $row[0],
                'facility_name' => $row[1],
                'latitude' => $row[2],
                'longitude' => $row[3],
                'common_name' => $row[4],
                'region' => $row[5],
                'district' => $row[6],
                'council' => $row[7],
                'ward' => $row[8],
                'street' => $row[9],
                'facility_type' => $row[10],
                'operating_status' => $row[11],
                'ownership' => $row[12],
                'date_opened' => $row[13],
                'official_phone_number' => $row[14],
                'mtuha' => $row[15],
                'ctc_id' => $row[16],
                'msd_id' => $row[17],
                'postal_address' => $row[18],
                'official_email' => $row[19],
                'website' => $row[20]
            ];

            if(!empty($arr)){
                DB::table('health_facilities')->insert($arr);
            }
        }

        return response()->json($arr);
    }

    private function getFilePath()
    {
        return 'health_facilities.xls';
    }
}
