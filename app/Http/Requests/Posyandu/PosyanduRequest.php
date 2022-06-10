<?php

namespace App\Http\Requests\Posyandu;

use Illuminate\Foundation\Http\FormRequest;

class PosyanduRequest extends FormRequest
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
            'name'              => 'required|string',
            'name_pic'          => 'required|string',
            'tb_rukun_warga_id' => 'required|exists:tb_rukun_wargas,id',
            'latitude'          => 'required',
            'longitude'         => 'required',
            'address'           => 'required|string',
            'status'            => 'required|in:active,inactive',
        ];
    }
}
