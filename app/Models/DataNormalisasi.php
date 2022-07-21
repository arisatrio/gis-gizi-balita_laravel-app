<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataNormalisasi extends Model
{
    protected $table = 'tb_data_normalisasi';
    protected $fillable = [
        'tb_data_training_id',
        'umur_norm',
        'jk_norm',
        'bb_norm',
        'tb_norm',
        'lk_norm',
        'ld_norm',
        'status_norm',
    ];
}
