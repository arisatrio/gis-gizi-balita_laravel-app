<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BalitaStatus extends Model
{
    protected $table = 'tb_balita_status';
    protected $fillable = [
        'tb_balita_id',
        'status'
    ];

    public function balita()
    {
        return $this->belongsTo(Balita::class, 'tb_balita_id');
    }

    public function scopeTotalGiziBuruk($query)
    {
        return $query->where('status', 0)->count();
    }

    public function scopeTotalGiziBaik($query)
    {
        return $query->where('status', 1)->count();
    }
}
