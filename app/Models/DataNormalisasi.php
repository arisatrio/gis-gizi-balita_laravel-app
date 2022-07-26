<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataNormalisasi extends Model
{
    protected $table = 'tb_data_normalisasis';
    protected $fillable = [
        'tb_data_training_id',
        'umur_norm',
        'jk_norm',
        'bb_norm',
        'status_norm',
    ];

    public function training()
    {
        return $this->belongsTo(DataTraining::class, 'tb_data_training_id');
    }

    public function testing()
    {
        return $this->hasMany(DataTesting::class, 'tb_data_normalisasi_id');
    }
}
