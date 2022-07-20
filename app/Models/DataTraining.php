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
        'tb',
        'lk',
        'ld',
        'status'
    ];
}
