<?php

namespace odbh\Http\Requests;


class UserUpdateRequest extends Request
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
        $user = $this->segment(3);
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
        $data = [
            'active' => 'required',
            'dlaznost' => 'required',
            'all_name' => 'required|min:7|max:50|cyrillic',
            'karta' => 'required_if:active,1|digits_between:4,7|unique:users,karta,'.$user,
            'short_name' => 'required:|min:4|max:50|cyrillic_with',
            'name' => 'required_if:active,1|min:4|max:10|latin|unique:users,name,'.$user,
            'password' => 'min:4|max:15|same:password2',
            'password2' => 'min:4|max:15|same:password',

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
     * @return array
     */
    public function messages()
    {
        return [
            'active.required' => 'Маркирай дали е действащ!',
            'dlaznost.required' => 'Избери длъжостта му!',

            'all_name.required' => 'Попълни името!',
            'all_name.min' => 'Минимален брой символи за името - 7!',

            'karta.unique' => 'Номера трябва да е уникален!',
            'karta.digits_between' => ' Полето трябва да има между 4 и 7 цифри без букви!',
            'karta.required_if' => ' Полето № на сл. Карта: се изисква когато е маркрано като Действащ!',

            'short_name.required' => 'Краткото име е задължително!',
            'short_name.min' => 'Минимален брой символи за кратко име - 4!',

            'name.min' => 'Минимален брой символи за името - 4!',
            'name.unique' => 'Логин името трябва да е уникално!',
            'name.required_if' => 'Полето Логин име: се изисква когато е маркрано като Действащ!',

            'password.required' => 'Паролата е задължителна!',
            'password.min' => 'Минимален брой символи за паролата - 4!',

            'rz.not_in'=>'Избран е Н-к отдел или Администратор - Маркирай "Контрол"!',
            'orz.not_in'=>'Избран е Н-к отдел или Администратор - Маркирай "Оперативна РЗ"!',
            'fsk.not_in'=>'Избран е Н-к отдел или Администратор - Маркирай "ФСК"!',
            'ppz.not_in'=>'Избран е Н-к отдел или Администратор - Маркирай "КППЗ"!',
            'lab.not_in'=>'Избран е Н-к отдел или Администратор - Маркирай "Лаборатория"!',

            'error_type.not_in'=>'Маркирай поне един Сектор!',

            'admin.required'=>'Маркирай дали има Администраторки права! Не е желателно да има повече от един Администратор!',
        ];
    }
}
