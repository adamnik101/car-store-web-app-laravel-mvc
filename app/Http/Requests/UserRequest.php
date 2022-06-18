<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'ime' => 'required|max:255|regex:/^[a-zA-Z]+$/',
            'prezime' => 'required|max:255|regex:/^[a-zA-Z]+$/',
            'email' => 'required|email|max:255|unique:App\Models\User',
            'tel' => 'required|min:10|numeric',
            'password' => 'required|min:8|confirmed',
        ];
    }
    public function messages()
    {
        return [
            'ime.required' => 'Morate uneti ime.',
            'ime.regex' => 'Ime mora sadrzati samo slova',
            'prezime.required' => 'Morate uneti prezime.',
            'prezime.regex' => 'Prezime mora sadrzati samo slova',
            'email.required' => 'Morate uneti email.',
            'email.unique' => 'Nalog sa tim mejlom vec postoji.',
            'tel.required' => 'Morate uneti telefon.',
            'tel.min' => 'Telefon mora sadrzati bar 10 cifara',
            'tel.numeric' => 'Morate uneti samo brojeve',

            'password.required' => 'Morate uneti lozinku.',
            'password.min' => 'Lozinka mora sadrzati bar 8 karaktera.',
            'password.confirmed' => 'Morate potvrditi lozinku.'
        ];
    }
}
