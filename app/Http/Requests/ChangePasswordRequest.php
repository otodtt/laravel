<?php

namespace odbh\Http\Requests;

use Auth;

use odbh\Http\Requests\Request;

class ChangePasswordRequest extends Request
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
            'old' => 'required|old_password:'. Auth::user()->password,
            'pass' => 'required|min:4|max:15|latin|different:old',
            'repeat' => 'required|same:pass',
        ];
    }

    /**
     * Мои съобщения за грешки.
     * @return array
     */
    public function messages()
    {
        return [
            'old.required' => 'Попълни старата парола!',
            'old.old_password' => 'Въведената парола не отговаря на старата.',

            'pass.required' => 'Попълни новата парола!',
            'pass.min' => 'Паролата трябва да съдържа минимум 4 символа!',
            'pass.max' => 'Паролата трябва да съдържа максимум 15 символа!',
            'pass.latin' => 'Използвай само латински букви!',
            'pass.different' => 'Новата парола трябва да е различна от старата!',

            'repeat.required' => 'Полето е ЗАДЪЛЖИТЕЛНО! Повтори паралат парола!',
            'repeat.same' => 'Паролите не съвпадат!',
        ];
    }
}
