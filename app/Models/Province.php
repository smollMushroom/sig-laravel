<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;
    protected $table = 'provinces';
    protected $fillable = ['province_name', 'alt_province_name', 'latitude', 'longitude'];

    public function getProvinceNameAttribute($value)
    {
        return ucwords(strtolower($value));
    }

    // Accessor untuk alt_Province_name
    public function getAltProvinceNameAttribute($value)
    {
        return ucwords(strtolower($value));
    }
}
