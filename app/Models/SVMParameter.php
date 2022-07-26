<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SVMParameter extends Model
{
    protected $table = 'tb_svm_parameters';
    protected $fillable = [
        'kernel', 
        'c_param',
        'degree',
        'gamma',
        'coef0',
        'tolerance',
        'cache',
        'probability_estimates'
    ];

    public function svmLog()
    {
        return $this->hasMany(SVMLog::class, 'tb_svm_parameter_id');
    }
}
