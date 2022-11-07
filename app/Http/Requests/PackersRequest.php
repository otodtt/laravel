<?php

namespace odbh\Http\Requests;

use odbh\Http\Requests\Request;

class PackersRequest extends Request
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
            'packer_name'=>'required|latin|min:3|max:300',
            'packer_address'=>'required|latin|min:5|max:500',
        ];
    }

    /**
     * Проверка на входящите данни и мои съобщения
     * @return array
     */
    public function messages()
    {
        return [
            'packer_name.required' => 'Напиши името на фирмата на английски!',
            'packer_name.latin' => 'Използвай латиница!',
            'packer_name.min' => 'Името се изписва с минимум 3 символа!',
            'packer_name.max' => 'Името се изписва с максимум 300 символа!',

            'packer_address.required' => 'Напиши адреса на фирмата на английски!',
            'packer_address.latin' => 'Използвай латиница!',
            'packer_address.min' => 'Адреса се изписва с минимум 5 символа!',
            'packer_address.max' => 'Адреса се изписва с максимум 500 символа!',
        ];
    }
}
