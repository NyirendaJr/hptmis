<?php

namespace App\Models\District;

use App\Models\Region\Region;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;

    public function region()
    {
        return $this->belongsTo(Region::class);
    }
}
