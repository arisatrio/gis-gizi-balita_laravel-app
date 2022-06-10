<?php

namespace App\Http\Requests\RW;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RukunWargaUpdateRequest extends FormRequest
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
            'name'          => [
                'required',
                'string',
                'numeric',
                Rule::unique('tb_rukun_wargas', 'name')->ignore($this->name)->whereNull('deleted_at'),
            ],
            'name_pic'      => 'required|string',
            'address'       => 'required|string',
            'description'   => 'nullable|string'
        ];
    }

    public function messages()
    {
        return [
            'name.required'     => 'RW harus di isi!',
            'name.unique'       => 'Data RW'.$this->name.' sudah ada!',
        ];
    }
}
