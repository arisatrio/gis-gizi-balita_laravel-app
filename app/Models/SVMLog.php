<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SVMLog extends Model
{
    protected $table = 'tb_svm_testing_logs';
    protected $fillable = [
        'total_data_to_train',
        'total_data_to_test',
        'user_id',
        'tb_svm_parameter_id'
    ];

    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->user_id = auth()->user()->id ?? 1;
        });
    }
}
