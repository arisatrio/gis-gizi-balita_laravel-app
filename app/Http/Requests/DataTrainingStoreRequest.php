<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DataTrainingStoreRequest extends FormRequest
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
            'umur'      => 'required|numeric|max:59',
            'jk'        => 'required',
            'bb'        => 'required|numeric',
            'tb'        => 'required|numeric',
            'lk'        => 'required|numeric',
            'ld'        => 'required|numeric',
            'status'    => 'required'
        ];
    }
}
