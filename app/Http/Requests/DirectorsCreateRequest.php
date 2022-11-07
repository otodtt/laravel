<?php

namespace odbh\Http\Requests;


class DirectorsCreateRequest extends Request
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
            'name' => 'required|min:2|max:50|cyrillic',
            'surname' => 'min:2|max:50|cyrillic',
            'family' => 'required|min:2|max:20|cyrillic',
            'degree' => 'min:2|max:20',
            'type_dir' => 'min:2|max:20|cyrillic_with',
            'start_date' => 'required|date_format:d.m.Y|min_date_create'
        ];
    }

    /**
     * Проверка на входящите данни
     * @return array
     */
    public function messages()
    {
        return [
            'type_dir.min' => 'Минимален брой символи - 2!',
            'type_dir.max' => 'Максимален брой символи - 20!',
            'degree.min' => 'Минимален брой символи - 2!',
            'degree.max' => 'Максимален брой символи - 20!',
            'start_date.required' => 'Избери Начална дата!',
            'start_date.date_format' => 'Некоректен формат на датата!',
            'name.cyrillic' => 'Пиши на кирилаца без символи и знаци!',
            'surname.cyrillic' => 'Пиши на кирилаца без символи и знаци!',
            'family.cyrillic' => 'Пиши на кирилаца без символи и знаци!',
            'type_dir.cyrillic_with'=>'Пиши на кирилаца!',
            'start_date.min_date_create'=>'Не може датата да е преди датата на назначаване на предишния Директор!'
        ];
    }
}
