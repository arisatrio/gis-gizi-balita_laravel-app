<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Balita extends Model
{
    use softDeletes;

    protected $table = 'tb_balitas';
    protected $fillable = [
        'id_kia',
        'tb_posyandu_id',
        'mother_name',
        'name',
        'birth',
        'gender',
        'address',
    ];
    protected $appends = ['age'];

    public function getAgeAttribute()
    {
        return Carbon::parse($this->birth)->diffInMonths(Carbon::now()).' Bulan';
    }

    public function posyandu()
    {
        return $this->belongsTo(Posyandu::class, 'tb_posyandu_id');
    }
}
