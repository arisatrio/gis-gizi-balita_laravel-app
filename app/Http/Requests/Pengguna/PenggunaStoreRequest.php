<?php

namespace App\Http\Requests\Pengguna;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PenggunaStoreRequest extends FormRequest
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
            'name'      => 'required',
            'email'     =>  [
                'required',
                Rule::unique('users', 'email')->ignore($this->email)->whereNull('deleted_at'),
            ],
            'password'  => 'nullable',
            'phone'     => 'nullable|numeric',
            'address'   => 'nullable',
            'role'      => 'required'
        ];
    }
}
