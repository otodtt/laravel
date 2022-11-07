<?php

namespace odbh\Http\Requests;

// use odbh\Http\Requests\Request;

class ImportersRequest extends Request
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

        $request = Request::all();
        
        if ($request['is_bulgarian'] == 0) {
            $is_valid = 'required|max:9|is_valid';
            $required = '|required';
        } else {
            $is_valid = '';
            $required = '';
        }

        return [
            'is_bulgarian'=>'required',
            'trade'=>'required',
            'name_bg'=>'cyrillic_with|min:3|max:300'.$required,
            'address_bg'=>'cyrillic_with|min:5|max:500'.$required,
            'name_en'=>'required|latin|min:3|max:300',
            'address_en'=>'required|latin|min:5|max:500',
            'vin'=> $is_valid.'|unique:importers,vin,'.$id,
        ];
    }

    /**
     * Проверка на входящите данни и мои съобщения
     * @return array
     */
    public function messages()
    {
        return [
            'is_bulgarian.required' => 'Избери дали фирмата е българска или не!',
            'trade.required' => 'Задължително маркирай дейността на фирмата!',

            'name_bg.cyrillic_with' => 'Използвай кирилица!',
            'name_bg.min' => 'Името се изписва с минимум 3 символа!',
            'name_bg.max' => 'Името се изписва с максимум 300 символа!',
            'name_bg.required' => 'Напиши името на фирмата на български!',
            
            'address_bg.cyrillic_with' => 'Използвай кирилица!',
            'address_bg.min' => 'Адреса се изписва с минимум 5 символа!',
            'address_bg.max' => 'Адреса се изписва с максимум 500 символа!',
            'address_bg.required' => 'Напиши адреса на фирмата на български!',

            'name_en.required' => 'Напиши името на фирмата на английски!',
            'name_en.latin' => 'Използвай латиница!',
            'name_en.min' => 'Името се изписва с минимум 3 символа!',
            'name_en.max' => 'Името се изписва с максимум 300 символа!',

            'address_en.required' => 'Напиши адреса на фирмата на английски!',
            'address_en.latin' => 'Използвай латиница!',
            'address_en.min' => 'Адреса се изписва с минимум 5 символа!',
            'address_en.max' => 'Адреса се изписва с максимум 500 символа!',

            'vin.required' => 'Попълни ЕИК/Булстат!',
            'vin.max' => 'Максимален брой символи за ЕИК/Булстат - 9! Провери дали няма прзен символ преди или след номера!',
            'vin.is_valid' => 'Невалиден ЕИК/Булстат!',
            'vin.unique' => 'ЕИК/Булстат е уникален! Виж дали няма вече добавена фирма с този ЕИК/Булстат!',
        ];
    }
}
