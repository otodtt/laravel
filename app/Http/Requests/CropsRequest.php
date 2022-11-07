<?php

namespace odbh\Http\Requests;

use odbh\Http\Requests\Request;

class CropsRequest extends Request
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
            'group_id'=> 'required',
            'name'=> 'required|min:3|max:100|cyrillic_with',
            'name_en'=> 'required|min:3|max:100|latin',
//            'latin'=> 'required|min:3|max:100|latin',
//            'cropDescription'=> 'required|min:5'
        ];
    }

    /**
     * Мои съобщения за грешки.
     * @return array
     */
    public function messages()
    {
        return [
            'group_id.required' => 'Избери Група!',

            'name.required' => 'Попълни името на Кутурата!',
            'name.min' => 'Минимален брой символи за името - 3!',
            'name.max' => 'Максимален брой символи за името - 100!',
            'name.cyrillic_with' => 'За име на Култура пиши само на кирилица!',

            'name_en.required' => 'Попълни името на Културата на английски!',
            'name_en.min' => 'Минимален брой символи за името на английски - 3!',
            'name_en.max' => 'Максимален брой символи за иметона английски - 100!',
            'name_en.latin' => 'За име на на английски пиши само на латински!',

//            'latin.required' => 'Попълни Латинското име на Културата!',
//            'latin.min' => 'Минимален брой символи за Латинското име - 3!',
//            'latin.max' => 'Максимален брой символи за Латинското име - 100!',
//            'latin.latin' => 'Латинското име пиши само на Латински, без симвоил!',
//
//            'cropDescription.required' => 'Попълни полето Description!',
//            'cropDescription.min' => 'Минимален брой символи за полето Description - 3!',
        ];
    }
}
