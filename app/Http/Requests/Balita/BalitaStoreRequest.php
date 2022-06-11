<?php

namespace App\Http\Requests\Balita;

use Illuminate\Foundation\Http\FormRequest;

class BalitaStoreRequest extends FormRequest
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
            'id_kia'            => 'required|numeric',
            'tb_posyandu_id'    => 'required|exists:tb_posyandus,id',
            'mother_name'       => 'required|string',
            'name'              => 'required|string',
            'birth'             => 'required|date_format:Y-m-d|before:today',
            'gender'            => 'required|in:L,P',
            'address'           => 'required|string',
        ];
    }
}