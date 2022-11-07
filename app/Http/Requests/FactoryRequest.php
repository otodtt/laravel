<?php

namespace odbh\Http\Requests;


class FactoryRequest extends Request
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
        if(isset($request['id_firm'])){
            $id = $request['id_firm'];
        } else {
            $id = 0;
        }

        if(!isset($request['gender']) || strlen($request['gender']) == 2){
            $pin = '';
            $owner = '';
        } else {
            $pin = 'required|pin_validate|digits_between:9,10';
            $owner = 'min:3|max:50|cyrillic|required';
        }

        return [
            'type_firm'=> 'required',
            'name'=> 'required|min:3|max:50|cyrillic_names',

            'areasID'=> 'required|not_in:0',
            'localsID'=> 'required|not_in:0',

            'list_name'=> 'required',
            'address'=> 'required|min:3|max:50|cyrillic_with',
            'owner'=> $owner,
            'gender'=> 'required',
            'pin'=> $pin,
            'bulstat'=> 'required|is_valid|digits_between:9,10|unique:factories,bulstat,'.$id,
            'phone'=> 'phone_validate',
            'mobil'=> 'mobile_validate',
            'email'=> 'email',
            'error'=>'in:0'
        ];
    }

    public function messages()
    {
        return [
            'type_firm.required' => 'Маркирай вида на фирмата!',

            'name.required' => 'Попълни името на фирмата!',
            'name.min' => 'Минимален брой символи за името - 3!',
            'name.max' => 'Минимален брой символи за името - 50!',
            'name.cyrillic_names' => 'За име на фирмата пиши само на кирилица без символи! Позволени символи: (тире - ) и цифри!',

            'areasID.not_in'=> 'Избери областта където е проверявания обект!',
            'areasID.required'=> 'Избери областта където е проверявания обект!',
            'localsID.not_in'=> 'Избери общината където е проверявания обект!',
            'localsID.required'=> 'Избери общината където е проверявания обект!',

            'list_name.required' => 'Избери населено място от списъка!',

            'address.required' => 'Попълни адреса на фирмата!',
            'address.min' => 'Минимален брой символи за адрес - 3!',
            'address.max' => 'Максимален брой символи за адрес - 50!',
            'address.cyrillic_with' => 'Пиши само на кирилица!!',

            'owner.required' => 'Попълни името на представителя!',
            'owner.min' => 'Минимален брой символи за име - 3!',
            'owner.max' => 'Минимален брой символи за име - 50!',
            'owner.cyrillic' => 'Пиши само на кирилица!!',

            'pin.required' => 'Попълни ЕГН!',
            'pin.pin_validate' => 'ЕГН-то не отговаря! Виж дали правилно са попълнени данните!',
            'pin.digits_between' => 'ЕГН-то е само цифри!',

            'gender.required' => 'Маркирай дали е мъж или жена!',

            'bulstat.required' => 'Булстата е задължителен!',
            'bulstat.digits_between' => 'Булстата е само с цифри! Минимален брой символи - 9',
            'bulstat.unique' => 'Булстата трябва да е уникален! Намерена е фирма с този БУЛСТАТ',
            'bulstat.is_valid' => 'Невалиден БУЛСТАТ! Виж дали правилно е попълнен!',

            'phone.phone_validate' => 'Некоректен формат на изписване на телефон.',
            'mobil.mobile_validate' => 'Некоректен формат на изписване на мобилен телефон.',

            'email.email' => 'Некоректен формат на електроната поща! Махни празните полета',
            'error.in' => 'Избери населено място от списъка! Виж да не е избрана друга община!',
        ];
    }
}
