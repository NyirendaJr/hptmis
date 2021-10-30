<?php

namespace App\Imports;

use App\Models\HealthFacility\HealthFacility;
use Maatwebsite\Excel\Concerns\ToModel;

class HealthFacilityImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new HealthFacility([
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
        ]);
    }
}
