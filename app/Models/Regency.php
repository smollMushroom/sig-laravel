<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class regency extends Model
{
    protected $table = 'regencies';
    protected $fillable = ['regency_name', 'alt_regency_name', 'latitude', 'longitude', 'province_id'];

    function province(){
        return $this->belongsTo(Province::class);
    }

    public function getRegencyNameAttribute($value)
    {
        return ucwords(strtolower($value));
    }

    // Accessor untuk alt_regency_name
    public function getAltRegencyNameAttribute($value)
    {
        return ucwords(strtolower($value));
    }
}
