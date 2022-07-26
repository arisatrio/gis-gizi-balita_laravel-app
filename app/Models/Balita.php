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
        'parent_id',
        'name',
        'birth',
        'gender',
        'address',
        'status',
    ];
    protected $dates = ['birth'];
    protected $appends = ['age'];

    public function getAgeAttribute()
    {
        return Carbon::parse($this->birth)->diffInMonths(Carbon::now()).' Bulan';
    }

    public function getFullAgeAttribute()
    {
        return Carbon::parse($this->birth)->diff(Carbon::now())->format('%y tahun %m bulan and %d hari');;
    }

    public function parent()
    {
        return $this->belongsTo(User::class, 'parent_id');
    }

    public function posyandu()
    {
        return $this->belongsTo(Posyandu::class, 'tb_posyandu_id');
    }

    public function checkUp()
    {
        return $this->hasMany(BalitaCheck::class, 'tb_balita_id')->orderByDesc('check_date');
    }

    public function statusGizi()
    {
        return $this->hasOne(BalitaCheck::class, 'tb_balita_id')->latest();
    }
}
