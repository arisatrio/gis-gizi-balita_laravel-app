<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RukunWarga extends Model
{
    use softDeletes;

    protected $table = 'tb_rukun_wargas';
    protected $fillable = [
        'name',
        'name_pic',
        'address',
        'description'
    ];

    public function getNameAttribute($value)
    {
        return 'RW.'.$value;
    }

    public function scopeOrderByRw($query)
    {
        return $query->orderBy('name');
    }

    public function posyandu()
    {
        return $this->hasOne(Posyandu::class);
    }
}
