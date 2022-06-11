<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class BalitaCheck extends Model
{
    use softDeletes;

    protected $table = 'tb_balita_checks';
    protected $fillable = [
        'tb_balita_id',
        'user_id',
        'check_date',
        'age',
        'bb',
        'tb',
        'lk',
        'ld',
        'status'
    ];
    protected $dates = ['check_date'];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $date   = Carbon::parse($model->check_date); 
            $age    = Carbon::parse($model->check_date)->diffInMonths(Carbon::parse($model->balita->birth));

            $model->check_date  = $date;
            $model->age         = $age;
        });
    }

    public function getAgeAttribute($value)
    {
        return $value.' Bulan';
    }

    public function balita()
    {
        return $this->belongsTo(Balita::class, 'tb_balita_id');
    }
}
