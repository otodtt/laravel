<?php

namespace odbh\Http\Requests;


class UserCreateRequest extends Request
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
        $request = Request::all();
        if($request['dlaznost'] == 1 || $request['admin'] == 2 ){
            $rz ='not_in:0';
            $orz ='not_in:0';
            $fsk ='not_in:0';
            $ppz ='not_in:0';
            $lab ='not_in:0';
        }
        else{
            $rz ='';
            $orz ='';
            $fsk ='';
            $ppz ='';
            $lab ='';
        }
        if($request['rz'] == 0 && $request['orz'] == 0 && $request['fsk'] == 0 && $request['ppz'] == 0 && $request['lab'] == 0 ){
            $error ='not_in:0';
        }
        else{
            $error = '';
        }

        if ($request['ppz'] == 1) {
            $name_en = 'required|min:7|max:50|latin';
        }
        else {
            $name_en = 'min:7|max:50|latin';
        }

        $data = [
            'active' => 'required',
            'dlaznost' => 'required',
            'all_name' => 'required|min:7|max:50|cyrillic',
            'all_name_en' => $name_en,
            'karta' => 'required_if:active,1|digits_between:4,7|unique:users,karta',
            'short_name' => 'required|min:4|max:50|cyrillic_with',
            'name' => 'required_if:active,1|min:4|max:10|unique:users,name|latin',
            'password' => 'required_if:active,1|min:4|max:15',
            'password2' => 'required_if:active,1|same:password',
            'stamp_number' => 'required_if:ppz,1|digits_between:2,7|unique:users,stamp_number',
            'admin'=>'required',

            'rz'=>$rz,
            'orz'=>$orz,
            'fsk'=>$fsk,
            'ppz'=>$ppz,
            'lab'=>$lab,
            'error_type'=>$error,
        ];
        return $data;
    }

    /**
     * Мои съобщения за грешки.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'active.required' => 'Маркирай дали е действащ!',
            'dlaznost.required' => 'Избери длъжостта му!',

            'all_name.required' => 'Попълни името!',
            'all_name.min' => 'Минимален брой символи за името - 7!',
            'all_name.cyrillic' => 'За името използвай кирилица!',

            'all_name_en.required' => 'Попълни името на англиски!',
            'all_name_en.min' => 'Минимален брой символи за името на англиски - 7!',
            'all_name_en.latin' => 'За името на англиски използвай латиница!',

            'karta.required_if' => 'Попълни Номера на картата!',
            'karta.unique' => 'Номера на Служебната карта трябва да е уникален!',
            'karta.digits_between' => ' Полето трябва да има между 4 и 7 цифри без букви!',

            'short_name.required' => 'Краткото име е задължително!',
            'short_name.min' => 'Минимален брой символи за кратко име!',

            'name.required_if' => 'Попълни Логин името!',
            'name.min' => 'Минимален брой символи за името - 4!',
            'name.unique' => 'Логин името трябва да е уникално!',

            'password.required_if' => 'Паролата е задължителна!',
            'password.min' => 'Минимален брой символи за паролата - 4!',

            'password2.required_if' => 'Повтори паролата!',
            'password2.same' => 'Паролите не отговарят!',

            'rz.not_in'=>'Избран е Н-к отдел или Администратор - Маркирай "Контрол"!',
            'orz.not_in'=>'Избран е Н-к отдел или Администратор - Маркирай "Оперативна РЗ"!',
            'fsk.not_in'=>'Избран е Н-к отдел или Администратор - Маркирай "ФСК"!',
            'ppz.not_in'=>'Избран е Н-к отдел или Администратор - Маркирай "КППЗ"!',
            'lab.not_in'=>'Избран е Н-к отдел или Администратор - Маркирай "Лаборатория"!',

            'error_type.not_in'=>'Маркирай поне един Сектор!',

            'admin.required'=>'Маркирай дали има Администраторки права! Не е желателно да има повече от един Администратор!',

            'stamp_number.required_if' => 'Попълни Номера на печата!',
            'stamp_number.unique' => 'Номера трябва да е уникален!',
            'stamp_number.digits_between' => ' Полето Номер на печат трябва да има между 2 и 7 цифри без букви!',
        ];
    }
}
