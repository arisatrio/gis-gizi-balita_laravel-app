<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Posyandu extends Model
{
    use softDeletes;
    
    protected $table = 'tb_posyandus';
    protected $fillable = [
        'tb_rukun_warga_id',
        'name',
        'name_pic',
        'address',
        'latitude',
        'longitude',
        'status',
    ];
    protected $appends = ['totalBalita'];

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function getNameAttribute($value)
    {
        return 'Posyandu '.$value.' ('.$this->rukunWarga->name.')';
    }

    public function rukunWarga()
    {
        return $this->belongsTo(RukunWarga::class, 'tb_rukun_warga_id');
    }

    public function balita()
    {
        return $this->hasMany(Balita::class, 'tb_posyandu_id');
    }

    public function getTotalBalitaAttribute()
    {
        return $this->balita()->count();
    }

    public function totalGiziBaik()
    {
        return $this->hasManyThrough(BalitaStatus::class, Balita::class, 'tb_posyandu_id', 'tb_balita_id')->where('status', 1);
    }

    public function totalGiziBuruk()
    {
        return $this->hasManyThrough(BalitaStatus::class, Balita::class, 'tb_posyandu_id', 'tb_balita_id')->where('status', 0);
    }
}
