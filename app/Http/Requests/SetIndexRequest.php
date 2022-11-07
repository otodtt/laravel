<?php

namespace odbh\Http\Requests;


class SetIndexRequest extends Request
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
            'index_in' => 'required',
            'index_out' => 'required',
        ];
    }

    /**
     * Проверка на входящите данни и мои съобщения
     * @return array
     */
    public function messages()
    {
        return [
            'index_in.required' => 'Индекса преди Входящия номер е Задължителен!',
            'index_out.required' => 'Индекса преди Изходящия номер е Задължителен!',
        ];
    }
}
