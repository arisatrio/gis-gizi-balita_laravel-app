<?php

namespace App\Http\Requests\CheckUp;

use Illuminate\Foundation\Http\FormRequest;

class CheckupStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'tb_balita_id'      => 'required|exists:tb_balitas,id',
            'user_id'           => 'required|exists:users,id',
            'check_date'        => 'required|before_or_equal:today',
            'bb'                => 'required|numeric',
            'tb'                => 'required|numeric',
            'lk'                => 'required|numeric',
            'ld'                => 'required|numeric',
        ];
    }
}
