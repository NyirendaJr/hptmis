<?php

namespace App\Models\Region;

use App\Models\District\District;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;

    public function districts()
    {
        return $this->hasMany(District::class);
    }
}
