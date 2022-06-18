<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DodajAdminRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'zapis' => 'required'
        ];
    }

    public function messages()
    {
        return [
          'zapis.required' => 'Morate uneti naziv!'
        ];
    }
}
