<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'email'=>'required|email',
            'text'=>'required',
            'subject' => 'required'
        ];
    }

    public function messages()
    {
       return [
           'email.required'=>'Morate uneti mail',
           'text.required'=>'Morate uneti poruku',
           'subject.required' => 'Morate uneti temu'
       ];
    }
}
