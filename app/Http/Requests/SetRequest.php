<?php

namespace odbh\Http\Requests;


class SetRequest extends Request
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
            'area_id' => 'required',
            'address'=>'required|cyrillic_with|min:4',
            'mail'=>'email|required',
            'phone'=>'phone_validate|required',
            'fax'=>'phone_validate',
        ];
    }

    /**
     * Проверка на входящите данни и мои съобщения
     * @return array
     */
    public function messages()
    {
        return [
            'area_id.required' => 'Избери област от падащото меню!',

            'address.min' => 'Минимален брой символи - 4!',
            'address.required' => 'Попълни адреса!',
            'address.cyrillic_with' => 'Адреса се изписва на кирилица!',

            'mail.email' => 'Грешен формат на ел. поща!',
            'mail.required' => 'Електронната поща е задължителна!',

            'phone.phone_validate' => 'Непозволен формат на изписване на телефон!',
            'phone.required' => 'Задължително се изписва телефон!',

            'fax.phone_validate' => 'Непозволен формат на изписване на факс!',
        ];
    }
}
