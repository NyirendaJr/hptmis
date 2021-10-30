<?php

namespace App\Models\Patient;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'nin',
        'first_name',
        'middle_name',
        'last_name',
        'dob',
        'gender',
        'residence',
        'phone_number',
        'region_id',
        'district_id',
        'health_facility_id'
    ];
}
