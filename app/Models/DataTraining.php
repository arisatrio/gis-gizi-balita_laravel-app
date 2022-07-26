<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataTraining extends Model
{
    protected $table = 'tb_data_trainings';
    protected $fillable = [
        'umur',
        'jk',
        'bb',
        'status'
    ];

    public function normalisasi()
    {
        return $this->hasOne(DataNormalisasi::class, 'tb_data_training_id');
    }
}
