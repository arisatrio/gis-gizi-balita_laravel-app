<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lokasi extends Model
{
    protected $table = 'tb_lokasis';
    protected $fillable = [
        'province',
        'district',
        'sub_district',
        'village',
        'border'
    ];

    public function getBorderAttribute($value)
    {
        return unserialize($value);
    }
}
