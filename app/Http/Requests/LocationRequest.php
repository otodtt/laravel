<?php

namespace odbh\Http\Requests;


class LocationRequest extends Request
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
        $id = $this->segment(3);

        return [
            'tvm'=>'required',
            'name'=>'required|only_cyrillic|min:2',
            'district_id'=>'required',
            'postal_code'=>'required|min:4|digits_between:4,4',
            'ekatte'=>'required|min:5|digits_between:5,5|unique:locations,ekatte,'.$id,
        ];
    }

    /**
     * Проверка на входящите данни и мои съобщения
     * @return array
     */
    public function messages()
    {
        return [
            'tvm.required' => 'Избреи дали е град или село!',

            'name.min' => 'Минимален брой символи - 2!',
            'name.required' => 'Напиши името на населеното място!',
            'name.only_cyrillic' => 'Напиши името на кирилица без символи!',

            'district_id.required' => 'Избери община!',

            'postal_code.required' => 'Пощенския код е задължителен!',
            'postal_code.digits_between' => 'За Пощенски код се използват само цифри!',
            'postal_code.min' => 'Пощенския код се изписва с минимум 4 символа!',

            'ekatte.unique' => 'ЕКАТТЕ-то трябва да е уникално! Има намерено населено място с това ЕКАТТЕ! ',
            'ekatte.required' => 'ЕКАТТЕ-то е задължително!',
            'ekatte.digits_between' => 'За ЕКАТТЕ се използват само цифри!',
            'ekatte.min' => 'ЕКАТТЕ се изписва с минимум 5 символа!',
        ];
    }
}
