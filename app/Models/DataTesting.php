<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataTesting extends Model
{
    protected $table = 'tb_data_testings';
    protected $fillable = [
        'tb_data_normalisasi_id',
        'status_testing'
    ];

    public function trainingNorm()
    {
        return $this->belongsTo(DataNormalisasi::class, 'tb_data_normalisasi_id');
    }
}
