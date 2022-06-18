<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOglasRequest extends FormRequest
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
            'marka' => 'required|regex:/^[1-9]+$/',
            'model' => 'required|regex:/^[1-9]+$/',
            'cena' => 'numeric|min:0|not_in:0|required',
            'godiste' => 'numeric',
            'kilometraza' => 'required|numeric',
            'karoserija' => 'regex:/^[1-9]+$/',
            'gorivo' => 'regex:/^[1-9]+$/',
            'brojVrata' => 'regex:/^[1-9]+$/',
            'grad' => 'regex:/^[1-9]+$/',
            'klima' => 'regex:/^[1-9]+$/',
            'boja' => 'regex:/^[1-9]+$/',
            'menjac' => 'regex:/^[1-9]+$/',
            'pogon' => 'regex:/^[1-9]+$/',
            'obelezje' => 'nullable',
            'opis' => 'nullable',
            'slika[]' => 'image|size:1024|array'
        ];
    }
    public function messages()
    {
        return [
            'marka.regex' => 'Morate izabrati marku!',
            'model.regex' =>'Morate izabrati model!',
            'cena.numeric' => 'Morate uneti cenu!',
            'godiste.numeric' => 'Morate izabrati godiste!',
            'karoserija.regex' => 'Morate izabrati karoseriju!',
            'gorivo.regex' => 'Morate izabrati gorivo!',
            'brojVrata.regex' => 'Morate izabrati broj vrata!',
            'grad.regex' => 'Morate izabrati grad!',
            'klima.regex' => 'Morate izabrati klimu!',
            'boja.regex' => 'Morate izabrati boju!',
            'menjac.regex' => 'Morate izabrati menjac!',
            'pogon.regex' => 'Morate izabrati pogon!',
            'slika[].size' => 'Velicina slike ne sme biti veca od 1MB!',
            'kilometraza.required' => 'Morate uneti kilometrazu!',
            'kilometraza.numeric' => 'Mozete uneti samo brojeve!'
        ];
    }
}
